<?php

namespace MarsGameBundle\Controller;

use MarsGameBundle\Entity\City;
use MarsGameBundle\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CityController extends Controller
{
    protected function getCity()
    {
        $session = $this->get('session');
        /** @var Player $user */
        $user = $this->getUser();
        $city = $session->get('city_id');
        if ($city == null) {
            $city = $user->getCities()[0]->getId();
            $session->set('city_id', $city);
        }

        return $city;
    }

    public function resourcesAction()
    {
        $id = $this->getCity();
        $city = $this->getDoctrine()->getRepository(City::class)->find($id); // ->findBy(array("player" => "15"));

        return $this->render('cities/partials/resources.html.twig', [
            'cities' => $city
        ]);
    }
}
