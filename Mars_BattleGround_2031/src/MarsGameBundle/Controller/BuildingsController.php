<?php

namespace MarsGameBundle\Controller;

use MarsGameBundle\Entity\Building;
use MarsGameBundle\Entity\GameResource;
use MarsGameBundle\Entity\City;
use MarsGameBundle\Entity\CityBuildings;
use MarsGameBundle\Entity\CityResource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class BuildingsController
 * @package MarsGameBundle\Controller
 * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
 */
class BuildingsController extends CityController
{

    /**
     * @Route("/buildings", name="buildings_list")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $city = $this->getDoctrine()->getRepository(City::class)->find($this->getCity());
        $resources = $this->getDoctrine()->getRepository(GameResource::class)->findAll();
        return $this->render('buildings/index.html.twig', [
            'buildings' => $city->getBuildings(),
            'resources' => $resources
        ]);
    }

    /**
 * @Route("/buildings/evolve/{id}", name="evolve")
 * @param $id
 *
 */
    public function evolve($id)
    {
        $city = $this->getDoctrine()->getRepository(City::class)->find($this->getCity());
        $building = $this->getDoctrine()->getRepository(Building::class)->find($id);
        $cityBuilding = $this->getDoctrine()->getRepository(CityBuildings::class)
            ->findOneBy(['city'=>$city,'building'=>$building]);
        $currentLevel = $cityBuilding->getLevel();
        $costs = $building->getCosts();
        $allResources = [];
        foreach ($costs as $cost) {
            $resourcesInCity = $this->getDoctrine()->getRepository(CityResource::class)
                ->findOneBy(['resource'=>$cost->getResource(),'city'=>$city]);
            if ($resourcesInCity->getAmount() >= ($cost->getAmount() * ($currentLevel + 1))) {
                $allResources[$cost->getResource()->getName()] = ($cost->getAmount() * ($currentLevel + 1));
            } else {
                return $this->redirectToRoute("buildings_list");
            }
        }

        $cityResources = $this->getDoctrine()->getRepository(CityResource::class)
            ->findBy(['city'=>$city]);

        $em = $this->getDoctrine()->getManager();
        foreach ($cityResources as $cityResource) {
            $name = $cityResource->getResource()->getName();
            $cost = $allResources[$name];
            $cityResource->setAmount(
                $cityResource->getAmount() - $cost
            );
            $em->persist($cityResource);
            $em->flush();
        }

        $em->persist($cityBuilding);
        $em->flush();

        $cityBuilding->setLevel($currentLevel + 1);
        $currentValuePerHour = $cityBuilding->getResourcesPerHour();
        $cityBuilding->setResourcesPerHour($currentValuePerHour + 300);
        $initialTime = $cityBuilding->getTimeToGetBuild();
        $cityBuilding->setTimeToGetBuild($initialTime + 120);
        $em->persist($cityBuilding);
        $em->flush();

        return $this->redirectToRoute("buildings_list");
    }
}
