<?php

namespace MarsGameBundle\Controller;

use Doctrine\ORM\Mapping\Cache;
use MarsGameBundle\Entity\Player;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $user = $this->getUser();
        if ($user) {
            /** @var Player $user */
            $session = $this->get('session');
            if (!$session->has('player_id')) {
                $session->set('player_id', $user->getCities()[0]->getId());
            }
        }
        return $this->render('home/index.html.twig');
    }
}
