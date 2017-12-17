<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $userManager = $this->get('app.manager.user');
        $user = $userManager->getCurrent();
        if (null === $user) {
            return $this->redirectToRoute('login');
        }
        return $this->redirectToRoute('list_events');
    }


    /**
     * @Route("/mentions", name="mentions")
     */
    public function cgvAction(){
        return $this->render('default/mentions.html.twig', []);
    }
}
