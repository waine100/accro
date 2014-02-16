<?php

namespace Zenweb\Aventure\ParcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Price
 */
class Price
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $price;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Price
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Price
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Price
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * @var \Zenweb\Aventure\ParcBundle\Entity\Activity
     */
    private $activity;


    /**
     * Set activity
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\Activity $activity
     * @return Price
     */
    public function setActivity(\Zenweb\Aventure\ParcBundle\Entity\Activity $activity = null)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return \Zenweb\Aventure\ParcBundle\Entity\Activity 
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Display a nice name
     * @return string
     */
    public function __toString(){
        return $this->name;
    }
    /**
     * @var boolean
     */
    private $enabled;


    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Price
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}
