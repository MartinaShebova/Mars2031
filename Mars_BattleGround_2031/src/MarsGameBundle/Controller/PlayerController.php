<?php

namespace MarsGameBundle\Controller;

use MarsGameBundle\Entity\Building;
use MarsGameBundle\Entity\GameResource;
use MarsGameBundle\Entity\City;
use MarsGameBundle\Entity\CityBuildings;
use MarsGameBundle\Entity\CityResource;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use MarsGameBundle\Entity\Player;
use MarsGameBundle\Form\PlayerType;
use MarsGameBundle\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PlayerController
 * @package MarsGameBundle\Controller
 * @Security("is_granted('IS_AUTHENTICATED_ANONYMOUSLY')")
 */
class PlayerController extends CityController
{
    const MIN_COORDINATE_X = 0;
    const MAX_COORDINATE_X = 1000;

    const MIN_COORDINATE_Y = 0;
    const MAX_COORDINATE_Y = 1000;

    const NUMBER_OF_CITIES_EVERY_PLAYER_STARTS_WITH = 3;

    const AMOUNT_OF_RESOURCES_EVERY_PLAYER_STARTS_WITH = 5000;

    private $generateRandomCityName = [ 'EvaCatt',
                                        'MandiMosier' ,
                                        'PearlCoakley',
                                        'GeorgiaNilles' ,
                                        'AmiraFonte'  ,
                                        'BrookLanasa'  ,
                                        'SalinaLanders' ,
                                        'PiaAntonucci ',
                                        'DarronSligh  ',
                                        'DungStovall  ',
                                        'PatriciaHouck ',
                                        'LeoniePennypacker',
                                        'UnPullen  ',
                                        'MargPittmon  ',
                                        'Brunilda Cahn'  ,
                                        'LaurindaMcgonigle' ,
                                        'LaceyBinkley  ',
                                        'GeorgiannaLintner' ,
                                        'KrystenReagle  ',
                                        'RuthannSarabia  ',
                                        'MirellaMoree  ',
                                        'WendieJustus ',
                                        'BobetteMundt  ',
                                        'CherishPalos  ',
                                        'ModestoArmond' ,
                                        'DeeannaFurry' ,
                                        'LaniTaul' ,
                                        'LynDowling' ,
                                        'EladiaDunkin' ,
                                        'AngelaEisenhart' ,
                                        'RowenaKo' ,
                                        'DoloresPalermo' ,
                                        'BeverleeBoardman' ,
                                        'TonetteNuckles' ,
                                        'CarinMariotti' ,
                                        'ShontaThurber' ,
                                        'BernardaAccardi ',
                                        'MarquitaSamuelson' ,
                                        'HyeBrunt ',
                                        'HoseaSperry ',
                                        'MervinDoll ',
                                        'VirgilDieckman ',
                                        'JoshNehls' ,
                                        'EddyMusante  ',
                                        'BulaBrower ',
                                        'CoralWhicker ',
                                        'ChasGatton' ,
                                    ];


    /**
     * @Route("/register", name="user_register")
     * @Security("is_granted('IS_AUTHENTICATED_ANONYMOUSLY')")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        // 1) build the form
        $player = new Player();
        $form = $this->createForm(PlayerType::class, $player);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
//            $password = $this->get('security.password_encoder')
//                ->encodePassword($player, $player->getPassword());
//            $player->setPassword($password);

            $getRequest = $request->request->get('user');
            $userName = $getRequest['username'];
            $fullName = $getRequest['fullName'];

            $password = $getRequest['password']['first'];

            $player->setUsername($userName);
            $player->setFullName($fullName);
            $player->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($player);
            $em->flush();

            $cityRepository = $this->getDoctrine()->getRepository(City::class);
            for ($i = 0; $i < self::NUMBER_OF_CITIES_EVERY_PLAYER_STARTS_WITH; $i++) {
                $coordinateX = -1;
                $coordinateY = -1;
                do {
                    $coordinateX = rand(self::MIN_COORDINATE_X, self::MAX_COORDINATE_X);
                    $coordinateY = rand(self::MIN_COORDINATE_Y, self::MAX_COORDINATE_Y);
                    $alreadyTakenCity = $cityRepository->findOneBy(
                        ['x' => $coordinateX, 'y' => $coordinateY]
                    );
                } while ($alreadyTakenCity !== null);

                $city = new City();
                $city->setX($coordinateX);
                $city->setX($coordinateX);
                $city->setY($coordinateY);
                $arrayOfNames = $this->generateRandomCityName;
                $cityNames = array_rand($arrayOfNames, 1);
                $getName = $arrayOfNames[$cityNames];
                $city->setCityName('City:' . PHP_EOL . ($i+1) . PHP_EOL . $getName);
                $city->setPlayer($player);
                $em->persist($city);
                $em->flush();

                $resourceRepository = $this->getDoctrine()->getRepository(GameResource::class);
                $resourceTypes = $resourceRepository->findAll();

                foreach ($resourceTypes as $resourceType) {
                    $cityResource = new CityResource();
                    $cityResource->setResource($resourceType);
                    $cityResource->setCity($city);
                    $cityResource->setAmount(self::AMOUNT_OF_RESOURCES_EVERY_PLAYER_STARTS_WITH);
                    $em->persist($cityResource);
                    $em->flush();
                }

                $buildingRepository = $this->getDoctrine()->getRepository(Building::class);
                $buildingTypes = $buildingRepository->findAll();
                foreach ($buildingTypes as $buildingType) {
                    $cityBuilding = new CityBuildings();
                    $cityBuilding->setCity($city);
                    $cityBuilding->setBuilding($buildingType);
                    $cityBuilding->setLevel(0);
                    $cityBuilding->setResourcesPerHour(300);
                    $cityBuilding->setTimeToGetBuild(120);
                    $em->persist($cityBuilding);
                    $em->flush();
                }

            }

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('security_login');
        }

        return $this->render(
            'user/register.html.twig',
            array('form' => $form->createView())
        );
    }



    /**
     *
     * @Route("/profile", name="user_profile")
     */
    public function profileAction()
    {
        /** @var Player $player */
        $player = $this->getUser();

        // return $this->render("home/index.html.twig");

        return $this->render("user/profile.html.twig", [
            'player'=>$player,
            'cityId' => $this->getCity()
        ]);
    }

    /**
     * @Route("/player/change_city/{id}", name="change_city")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function changeCity($id)
    {
        /** @var Player $player */
        $player = $this->getUser();
        $cityRepository = $this->getDoctrine()->getRepository(City::class);
        $city = $cityRepository->findOneBy(
            [
                'id'=>$id,
                'player'=>$player
            ]
        );
        if ($city === null) {
            return $this->redirectToRoute("security_logout");
        }

        $this->get('session')->set('city_id', $id);

        return $this->redirectToRoute("user_profile");
    }


}
