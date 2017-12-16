<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
        $eventManager = $this->get('app.manager.event');
        $events = $eventManager->getAllEvents();

        return $this->render('event/list.html.twig', [
            "events" => $events
        ]);
    }

    /**
     * @Route("/{id}/{name}", name="show_event")
     */
    public function showEvent($id, $name){

        $eventManager = $this->get('app.manager.event');
        dump($id);
        $event = $eventManager->getEvent($id);
        dump($event);
        return $this->render('event/show.html.twig', [
            "event" => $event
        ]);
    }
}