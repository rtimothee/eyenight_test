<?php

namespace AppBundle\Manager;


use AppBundle\Model\Event;
use AppBundle\Model\Product;
use AppBundle\Utils\ParseHelper;
use Parse\ParseObject;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class EventManager implements EventManagerInterface
{
    protected $parse;

    public function __construct(ParseHelper $parse)
    {
        $this->parse = $parse;
    }

    public function getAllEvents()
    {
        try {
            $allEvents = $this->parse->getAll('Event', 10);
        }catch(\Exception $e){
            if($e->getCode() === 209){
                throw new \Exception("Parse : Unauthorized User", 209);
            }
            else{
                throw new \Exception($e->getMessage(), 500);
            }
        }
        $events = [];
        foreach ($allEvents as $e) {
            $event = new Event($e->getObjectId());
            $event = $this->mapDatas($e, $event);
            $events[] = $event;
        }

        return $events;
    }

    public function getEvent($id)
    {
        $parseEvent = $this->parse->get('Event', $id);
        $event = new Event($parseEvent->getObjectId());
        $event = $this->mapDatas($parseEvent, $event);

        $event->setProducts($this->getProductsForEvent($event->getId()));

        return $event;
    }

    private function getProductsForEvent($objectId)
    {
        $parseProducts = $this->parse->getLinkedObjects("Product", "Event", $objectId);
        $products = [];
        foreach ($parseProducts as $p) {
            $product = new Product($p->getObjectId());
            $product = $this->mapDatas($p, $product);
            $products[] = $product;
        }

        return $products;
    }

    private function mapDatas(ParseObject $e, $object)
    {
        $keys = $object->getPopulableFields();
        foreach ($keys as $key) {
            $methodName = 'set' . ucfirst($key);
            if (method_exists($object, $methodName) && $e->get($key)) {
                if ('image' === $key || 'location' === $key) {
                    $object->$methodName($e->get($key)->_encode());
                } else {
                    $object->$methodName($e->get($key));
                }
            }
        }
        return $object;
    }
}