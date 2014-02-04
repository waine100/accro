<?php

namespace Zenweb\Accro\ParcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Booking
 */
class Booking
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $theDate;


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
     * Set theDate
     *
     * @param \DateTime $theDate
     * @return Booking
     */
    public function setTheDate($theDate)
    {
        $this->theDate = $theDate;

        return $this;
    }

    /**
     * Get theDate
     *
     * @return \DateTime 
     */
    public function getTheDate()
    {
        return $this->theDate;
    }
    /**
     * @var \Zenweb\Accro\ParcBundle\Entity\Parc
     */
    private $parc;


    /**
     * Set parc
     *
     * @param \Zenweb\Accro\ParcBundle\Entity\Parc $parc
     * @return Booking
     */
    public function setParc(\Zenweb\Accro\ParcBundle\Entity\Parc $parc = null)
    {
        $this->parc = $parc;

        return $this;
    }

    /**
     * Get parc
     *
     * @return \Zenweb\Accro\ParcBundle\Entity\Parc 
     */
    public function getParc()
    {
        return $this->parc;
    }
    /**
     * @var \Zenweb\Accro\ParcBundle\Entity\TypicalDay
     */
    private $typicalDay;


    /**
     * Set typicalDay
     *
     * @param \Zenweb\Accro\ParcBundle\Entity\TypicalDay $typicalDay
     * @return Booking
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
}
