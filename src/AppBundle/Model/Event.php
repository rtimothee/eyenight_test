<?php

namespace AppBundle\Model;


class Event
{
    protected $id;
    protected $name;
    protected $startDate;
    protected $endDate;
    protected $address;
    protected $locationName;
    protected $city;
    protected $location;
    protected $image;
    protected $numberOfEntranceTicketsBought;
    protected $numberOfEntranceTicketsScanned;
    protected $published;
    protected $currentParticipants;

    protected $products;

    /**
     * Event constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;

        $this->products = [];
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getLocationName()
    {
        return $this->locationName;
    }

    /**
     * @param mixed $locationName
     */
    public function setLocationName($locationName)
    {
        $this->locationName = $locationName;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getNumberOfEntranceTicketsBought()
    {
        return $this->numberOfEntranceTicketsBought;
    }

    /**
     * @param mixed $numberOfEntranceTicketsBought
     */
    public function setNumberOfEntranceTicketsBought($numberOfEntranceTicketsBought)
    {
        $this->numberOfEntranceTicketsBought = $numberOfEntranceTicketsBought;
    }

    /**
     * @return mixed
     */
    public function getNumberOfEntranceTicketsScanned()
    {
        return $this->numberOfEntranceTicketsScanned;
    }

    /**
     * @param mixed $numberOfEntranceTicketsScanned
     */
    public function setNumberOfEntranceTicketsScanned($numberOfEntranceTicketsScanned)
    {
        $this->numberOfEntranceTicketsScanned = $numberOfEntranceTicketsScanned;
    }

    /**
     * @return mixed
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param mixed $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * @return mixed
     */
    public function getCurrentParticipants()
    {
        return $this->currentParticipants;
    }

    /**
     * @param mixed $currentParticipants
     */
    public function setCurrentParticipants($currentParticipants)
    {
        $this->currentParticipants = $currentParticipants;
    }

    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param array $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @return array
     */
    public function getPopulableFields()
    {
        return [
            "name",
            "startDate",
            "endDate",
            "address",
            "locationName",
            "city",
            "location",
            "image",
            "numberOfEntranceTicketsBought",
            "numberOfEntranceTicketsScanned",
            "published",
            "currentParticipants"
        ];
    }


}