<?php

namespace Zenweb\Aventure\ParcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SalesFlatOrder
 */
class SalesFlatOrder
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $baseTotal;

    /**
     * @var string
     */
    private $baseTotalPaid;

    /**
     * @var string
     */
    private $parc;

    /**
     * @var \DateTime
     */
    private $bookingDate;

    /**
     * @var string
     */
    private $checkoutMethod;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var string
     */
    private $couponCode;


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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return SalesFlatOrder
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return SalesFlatOrder
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return SalesFlatOrder
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return SalesFlatOrder
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set baseTotal
     *
     * @param string $baseTotal
     * @return SalesFlatOrder
     */
    public function setBaseTotal($baseTotal)
    {
        $this->baseTotal = $baseTotal;

        return $this;
    }

    /**
     * Get baseTotal
     *
     * @return string 
     */
    public function getBaseTotal()
    {
        return $this->baseTotal;
    }

    /**
     * Set baseTotalPaid
     *
     * @param string $baseTotalPaid
     * @return SalesFlatOrder
     */
    public function setBaseTotalPaid($baseTotalPaid)
    {
        $this->baseTotalPaid = $baseTotalPaid;

        return $this;
    }

    /**
     * Get baseTotalPaid
     *
     * @return string 
     */
    public function getBaseTotalPaid()
    {
        return $this->baseTotalPaid;
    }

    /**
     * Set parc
     *
     * @param string $parc
     * @return SalesFlatOrder
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
     * Set bookingDate
     *
     * @param \DateTime $bookingDate
     * @return SalesFlatOrder
     */
    public function setBookingDate($bookingDate)
    {
        $this->bookingDate = $bookingDate;

        return $this;
    }

    /**
     * Get bookingDate
     *
     * @return \DateTime 
     */
    public function getBookingDate()
    {
        return $this->bookingDate;
    }

    /**
     * Set checkoutMethod
     *
     * @param string $checkoutMethod
     * @return SalesFlatOrder
     */
    public function setCheckoutMethod($checkoutMethod)
    {
        $this->checkoutMethod = $checkoutMethod;

        return $this;
    }

    /**
     * Get checkoutMethod
     *
     * @return string 
     */
    public function getCheckoutMethod()
    {
        return $this->checkoutMethod;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return SalesFlatOrder
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set couponCode
     *
     * @param string $couponCode
     * @return SalesFlatOrder
     */
    public function setCouponCode($couponCode)
    {
        $this->couponCode = $couponCode;

        return $this;
    }

    /**
     * Get couponCode
     *
     * @return string 
     */
    public function getCouponCode()
    {
        return $this->couponCode;
    }
}
