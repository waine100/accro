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
     *
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
     *
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
     *
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
     *
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
     *
     * @return string
     */
    public function __toString()
    {
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
     *
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

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $groups;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->TierPrices = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add groups
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\Group $groups
     *
     * @return Price
     */
    public function addGroup(\Zenweb\Aventure\ParcBundle\Entity\Group $groups)
    {
        $this->groups[] = $groups;

        return $this;
    }

    /**
     * Remove groups
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\Group $groups
     */
    public function removeGroup(\Zenweb\Aventure\ParcBundle\Entity\Group $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $TierPrices;


    /**
     * Add TierPrices
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\TierPrice $tierPrices
     *
     * @return Price
     */
    public function addTierPrice(\Zenweb\Aventure\ParcBundle\Entity\TierPrice $tierPrices)
    {
        $tierPrices->setActivityPrice($this);
        $this->TierPrices->add($tierPrices);

        return $this;
    }

    /**
     * Remove TierPrices
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\TierPrice $tierPrices
     */
    public function removeTierPrice(\Zenweb\Aventure\ParcBundle\Entity\TierPrice $tierPrices)
    {
        $this->TierPrices->removeElement($tierPrices);
    }

    /**
     * Get TierPrices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTierPrices()
    {
        return $this->TierPrices;
    }

}
