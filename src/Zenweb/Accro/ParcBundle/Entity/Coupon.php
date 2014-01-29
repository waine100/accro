<?php

namespace Zenweb\Accro\ParcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Coupon
 */
class Coupon
{
    /**
     * Rule type actions
     */
    const BY_PERCENT_ACTION = 'by_percent';
    const BY_FIXED_ACTION   = 'by_fixed';

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
    private $code;

    /**
     * @var \DateTime
     */
    private $fromDate;

    /**
     * @var \DateTime
     */
    private $toDate;

    /**
     * @var integer
     */
    private $usesPerCustomer;

    /**
     * @var integer
     */
    private $isActive;

    /**
     * @var integer
     */
    private $stopRulesProcessing;

    /**
     * @var integer
     */
    private $sortOrder;

    /**
     * @var string
     */
    private $simpleAction;

    /**
     * @var string
     */
    private $discountAmount;

    /**
     * @var integer
     */
    private $timesUsed = 0;

    /**
     * @var integer
     */
    private $usesPerCoupon;

    /**
     * @var \Zenweb\Accro\ParcBundle\Entity\Parc
     */
    private $parc;

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
     * @return Coupon
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
     * @return Coupon
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
     * Set code
     *
     * @param string $code
     *
     * @return Coupon
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set fromDate
     *
     * @param \DateTime $fromDate
     *
     * @return Coupon
     */
    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    /**
     * Get fromDate
     *
     * @return \DateTime
     */
    public function getFromDate()
    {
        return $this->fromDate;
    }

    /**
     * Set toDate
     *
     * @param \DateTime $toDate
     *
     * @return Coupon
     */
    public function setToDate($toDate)
    {
        $this->toDate = $toDate;

        return $this;
    }

    /**
     * Get toDate
     *
     * @return \DateTime
     */
    public function getToDate()
    {
        return $this->toDate;
    }

    /**
     * Set usesPerCustomer
     *
     * @param integer $usesPerCustomer
     *
     * @return Coupon
     */
    public function setUsesPerCustomer($usesPerCustomer)
    {
        $this->usesPerCustomer = $usesPerCustomer;

        return $this;
    }

    /**
     * Get usesPerCustomer
     *
     * @return integer
     */
    public function getUsesPerCustomer()
    {
        return $this->usesPerCustomer;
    }

    /**
     * Set isActive
     *
     * @param integer $isActive
     *
     * @return Coupon
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return integer
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set stopRulesProcessing
     *
     * @param integer $stopRulesProcessing
     *
     * @return Coupon
     */
    public function setStopRulesProcessing($stopRulesProcessing)
    {
        $this->stopRulesProcessing = $stopRulesProcessing;

        return $this;
    }

    /**
     * Get stopRulesProcessing
     *
     * @return integer
     */
    public function getStopRulesProcessing()
    {
        return $this->stopRulesProcessing;
    }

    /**
     * Set sortOrder
     *
     * @param integer $sortOrder
     *
     * @return Coupon
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * Get sortOrder
     *
     * @return integer
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * Set simpleAction
     *
     * @param string $simpleAction
     *
     * @return Coupon
     */
    public function setSimpleAction($simpleAction)
    {
        $this->simpleAction = $simpleAction;

        return $this;
    }

    /**
     * Get simpleAction
     *
     * @return string
     */
    public function getSimpleAction()
    {
        return $this->simpleAction;
    }

    /**
     * Set discountAmount
     *
     * @param string $discountAmount
     *
     * @return Coupon
     */
    public function setDiscountAmount($discountAmount)
    {
        $this->discountAmount = $discountAmount;

        return $this;
    }

    /**
     * Get discountAmount
     *
     * @return string
     */
    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    /**
     * Set timesUsed
     *
     * @param integer $timesUsed
     *
     * @return Coupon
     */
    public function setTimesUsed($timesUsed)
    {
        $this->timesUsed = $timesUsed;

        return $this;
    }

    /**
     * Get timesUsed
     *
     * @return integer
     */
    public function getTimesUsed()
    {
        return $this->timesUsed;
    }

    /**
     * Set usesPerCoupon
     *
     * @param integer $usesPerCoupon
     *
     * @return Coupon
     */
    public function setUsesPerCoupon($usesPerCoupon)
    {
        $this->usesPerCoupon = $usesPerCoupon;

        return $this;
    }

    /**
     * Get usesPerCoupon
     *
     * @return integer
     */
    public function getUsesPerCoupon()
    {
        return $this->usesPerCoupon;
    }

    /**
     * Set parc
     */
    public function setParc(\Zenweb\Accro\ParcBundle\Entity\Parc $parc)
    {
        $this->parc = $parc;
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
}
