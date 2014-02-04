<?php

namespace Zenweb\Accro\ParcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimeSlot
 */
class TimeSlot
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $beginTime;

    /**
     * @var \DateTime
     */
    private $endTime;

    /**
     * @var integer
     */
    private $capacity;


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
     * Set beginTime
     *
     * @param \DateTime $beginTime
     * @return TimeSlot
     */
    public function setBeginTime($beginTime)
    {
        $this->beginTime = $beginTime;

        return $this;
    }

    /**
     * Get beginTime
     *
     * @return \DateTime 
     */
    public function getBeginTime()
    {
        return $this->beginTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     * @return TimeSlot
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     * @return TimeSlot
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
     * @var \Zenweb\Accro\ParcBundle\Entity\TypicalDay
     */
    private $typicalDay;

    /**
     * @var \Zenweb\Accro\ParcBundle\Entity\Activity
     */
    private $activity;


    /**
     * Set typicalDay
     *
     * @param \Zenweb\Accro\ParcBundle\Entity\TypicalDay $typicalDay
     * @return TimeSlot
     */
    public function setTypicalDay(\Zenweb\Accro\ParcBundle\Entity\TypicalDay $typicalDay = null)
    {
        $this->typicalDay = $typicalDay;

        return $this;
    }

    /**
     * Get typicalDay
     *
     * @return \Zenweb\Accro\ParcBundle\Entity\TypicalDay 
     */
    public function getTypicalDay()
    {
        return $this->typicalDay;
    }

    /**
     * Set activity
     *
     * @param \Zenweb\Accro\ParcBundle\Entity\Activity $activity
     * @return TimeSlot
     */
    public function setActivity(\Zenweb\Accro\ParcBundle\Entity\Activity $activity = null)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return \Zenweb\Accro\ParcBundle\Entity\Activity 
     */
    public function getActivity()
    {
        return $this->activity;
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
        /**
         * @TODO add a nice display name
         */
        //return $this->name;
    }
}
