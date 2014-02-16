<?php

namespace Zenweb\Aventure\ParcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 */
class Activity
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
     * @var integer
     */
    private $capacity;

    /**
     * @var integer
     */
    private $qtyMin;

    /**
     * @var boolean
     */
    private $visibility;


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
     * @return Activity
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
     * @return Activity
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
     * Set capacity
     *
     * @param integer $capacity
     * @return Activity
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer 
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set qtyMin
     *
     * @param integer $qtyMin
     * @return Activity
     */
    public function setQtyMin($qtyMin)
    {
        $this->qtyMin = $qtyMin;

        return $this;
    }

    /**
     * Get qtyMin
     *
     * @return integer 
     */
    public function getQtyMin()
    {
        return $this->qtyMin;
    }

    /**
     * Set visibility
     *
     * @param boolean $visibility
     * @return Activity
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * Get visibility
     *
     * @return boolean 
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Now some real methods
     */

    /**
     * Display a nice name
     *
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $Prices;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Prices = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add Prices
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\Price $prices
     * @return Activity
     */
    public function addPrice(\Zenweb\Aventure\ParcBundle\Entity\Price $prices)
    {
        $this->Prices[] = $prices;

        return $this;
    }

    /**
     * Remove Prices
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\Price $prices
     */
    public function removePrice(\Zenweb\Aventure\ParcBundle\Entity\Price $prices)
    {
        $this->Prices->removeElement($prices);
    }

    /**
     * Get Prices
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrices()
    {
        return $this->Prices;
    }
}
