<?php

namespace Zenweb\Aventure\ParcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TierPrice
 */
class TierPrice
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $qty;

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
     * Set qty
     *
     * @param integer $qty
     * @return TierPrice
     */
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Get qty
     *
     * @return integer 
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return TierPrice
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
     * @var \Zenweb\Aventure\ParcBundle\Entity\Price
     */
    private $activity_price;


    /**
     * Set activity_price
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\Price $activityPrice
     * @return TierPrice
     */
    public function setActivityPrice(\Zenweb\Aventure\ParcBundle\Entity\Price $activityPrice = null)
    {
        $this->activity_price = $activityPrice;

        return $this;
    }

    /**
     * Get activity_price
     *
     * @return \Zenweb\Aventure\ParcBundle\Entity\Price 
     */
    public function getActivityPrice()
    {
        return $this->activity_price;
    }
}
