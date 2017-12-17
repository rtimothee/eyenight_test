<?php

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/{id}", name="show_event")
     */
    public function showEvent($id){

        $eventManager = $this->get('app.manager.event');
        $event = $eventManager->getEvent($id);

        return $this->render('event/content.html.twig', [
            "event" => $event
        ]);
    }
}