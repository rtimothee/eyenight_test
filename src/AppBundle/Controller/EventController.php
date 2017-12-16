<?php
/**
 * Created by PhpStorm.
 * User: timotheeroldao
 * Date: 16/12/2017
 * Time: 01:54
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/event")
 */
class EventController extends Controller implements AuthController
{
    /**
     * @Route("/list", name="list_events")
     */
    public function getListEvents()
    {
        return $this->render('event/list.html.twig', []);
    }
}