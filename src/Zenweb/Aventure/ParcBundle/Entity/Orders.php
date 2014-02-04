<?php

namespace Zenweb\Aventure\ParcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 */
class Orders
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $parc;

    /**
     * @var \DateTime
     */
    private $reservationDate;


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
     * Set parc
     *
     * @param string $parc
     * @return Orders
     */
    public function setParc($parc)
    {
        $this->parc = $parc;

        return $this;
    }

    /**
     * Get parc
     *
     * @return string 
     */
    public function getParc()
    {
        return $this->parc;
    }

    /**
     * Set reservationDate
     *
     * @param \DateTime $reservationDate
     * @return Orders
     */
    public function setReservationDate($reservationDate)
    {
        $this->reservationDate = $reservationDate;

        return $this;
    }

    /**
     * Get reservationDate
     *
     * @return \DateTime 
     */
    public function getReservationDate()
    {
        return $this->reservationDate;
    }
}
