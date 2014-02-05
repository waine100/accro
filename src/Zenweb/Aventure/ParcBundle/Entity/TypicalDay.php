<?php

namespace Zenweb\Aventure\ParcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypicalDay
 */
class TypicalDay
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
    private $color;

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
     * @return TypicalDay
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
     * @return TypicalDay
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
     * Set color
     *
     * @param string $color
     *
     * @return TypicalDay
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $TimeSlots;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->TimeSlots = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add TimeSlots
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\TimeSlot $timeSlots
     * @return TypicalDay
     */
    public function addTimeSlot(\Zenweb\Aventure\ParcBundle\Entity\TimeSlot $timeSlots)
    {
        $this->TimeSlots[] = $timeSlots;

        return $this;
    }

    /**
     * Remove TimeSlots
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\TimeSlot $timeSlots
     */
    public function removeTimeSlot(\Zenweb\Aventure\ParcBundle\Entity\TimeSlot $timeSlots)
    {
        $this->TimeSlots->removeElement($timeSlots);
    }

    /**
     * Get TimeSlots
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTimeSlots()
    {
        return $this->TimeSlots;
    }
}
