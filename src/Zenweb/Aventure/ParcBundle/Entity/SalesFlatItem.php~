<?php

namespace Zenweb\Aventure\ParcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SalesFlatItem
 */
class SalesFlatItem
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
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $qty;

    /**
     * @var string
     */
    private $basePrice;

    /**
     * @var string
     */
    private $rowTotal;


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
     * @return SalesFlatItem
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
     * @return SalesFlatItem
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
     * Set name
     *
     * @param string $name
     * @return SalesFlatItem
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
     * @return SalesFlatItem
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
     * Set qty
     *
     * @param integer $qty
     * @return SalesFlatItem
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
     * Set basePrice
     *
     * @param string $basePrice
     * @return SalesFlatItem
     */
    public function setBasePrice($basePrice)
    {
        $this->basePrice = $basePrice;

        return $this;
    }

    /**
     * Get basePrice
     *
     * @return string 
     */
    public function getBasePrice()
    {
        return $this->basePrice;
    }

    /**
     * Set rowTotal
     *
     * @param string $rowTotal
     * @return SalesFlatItem
     */
    public function setRowTotal($rowTotal)
    {
        $this->rowTotal = $rowTotal;

        return $this;
    }

    /**
     * Get rowTotal
     *
     * @return string 
     */
    public function getRowTotal()
    {
        return $this->rowTotal;
    }
    /**
     * @var \Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder
     */
    private $order;


    /**
     * Set order
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder $order
     * @return SalesFlatItem
     */
    public function setOrder(\Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Update the timestamps on each save.
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    /**
     * Calculate the row total depending, on timeslot, qty and tierprice.
     */
    public function calculateRowTotal($userId)
    {
        /*$groupsId = array();
        $groups = $this->getDoctrine()
            ->getManager()
            ->getRepository('ZenwebAventureParcBundle:User')
            ->find($userId)
            ->getGroups();

        foreach ($groups as $group) {
            $groupsId[] = $group->getId();
        }

        $prices = $this->getDoctrine()
            ->getManager()
            ->getRepository('ZenwebAventureParcBundle:Price')
            ->getAvailablePrices($groupsId, $idTimeSlot, $qty);*/
    }
    /**
     * @var \Zenweb\Aventure\ParcBundle\Entity\TimeSlot
     */
    private $timeSlot;


    /**
     * Set timeSlot
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\TimeSlot $timeSlot
     * @return SalesFlatItem
     */
    public function setTimeSlot(\Zenweb\Aventure\ParcBundle\Entity\TimeSlot $timeSlot = null)
    {
        $this->timeSlot = $timeSlot;

        return $this;
    }

    /**
     * Get timeSlot
     *
     * @return \Zenweb\Aventure\ParcBundle\Entity\TimeSlot 
     */
    public function getTimeSlot()
    {
        return $this->timeSlot;
    }
}
