<?php

namespace AppBundle\Model;


class Product
{
    protected $id;
    protected $price;
    protected $name;
    protected $event;
    protected $quantityLeft;
    protected $maxQuantity;
    protected $entranceValidations;
    protected $barValidations;
    protected $order;

    /**
     * Product constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getQuantityLeft()
    {
        return $this->quantityLeft;
    }

    /**
     * @param mixed $quantityLeft
     */
    public function setQuantityLeft($quantityLeft)
    {
        $this->quantityLeft = $quantityLeft;
    }

    /**
     * @return mixed
     */
    public function getMaxQuantity()
    {
        return $this->maxQuantity;
    }

    /**
     * @param mixed $maxQuantity
     */
    public function setMaxQuantity($maxQuantity)
    {
        $this->maxQuantity = $maxQuantity;
    }

    /**
     * @return mixed
     */
    public function getEntranceValidations()
    {
        return $this->entranceValidations;
    }

    /**
     * @param mixed $entranceValidations
     */
    public function setEntranceValidations($entranceValidations)
    {
        $this->entranceValidations = $entranceValidations;
    }

    /**
     * @return mixed
     */
    public function getBarValidations()
    {
        return $this->barValidations;
    }

    /**
     * @param mixed $barValidations
     */
    public function setBarValidations($barValidations)
    {
        $this->barValidations = $barValidations;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return array
     */
    public function getPopulableFields()
    {
        return [
            "price",
            "name",
            "quantityLeft",
            "maxQuantity",
            "entranceValidations",
            "barValidations",
            "order"
        ];
    }
}