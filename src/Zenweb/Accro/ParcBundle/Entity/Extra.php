<?php

namespace Zenweb\Accro\ParcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Extra
 */
class Extra
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
    private $pricePerUnit;

    /**
     * @var integer
     */
    private $qtyMin;

    /**
     * @var boolean
     */
    private $visibility;

    /**
     * @var boolean
     */
    private $status;


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
     * @return Extra
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
     * @return Extra
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
     * Set pricePerUnit
     *
     * @param string $pricePerUnit
     * @return Extra
     */
    public function setPricePerUnit($pricePerUnit)
    {
        $this->pricePerUnit = $pricePerUnit;

        return $this;
    }

    /**
     * Get pricePerUnit
     *
     * @return string 
     */
    public function getPricePerUnit()
    {
        return $this->pricePerUnit;
    }

    /**
     * Set qtyMin
     *
     * @param integer $qtyMin
     * @return Extra
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
     * @return Extra
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
     * Set status
     *
     * @param boolean $status
     * @return Extra
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
