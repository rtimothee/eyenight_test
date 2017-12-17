<?php

namespace AppBundle\Manager;


interface EventManagerInterface
{
    public function getAllEvents();

    public function getEvent($id);

}