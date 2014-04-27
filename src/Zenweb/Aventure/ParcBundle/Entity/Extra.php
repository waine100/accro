<?php

namespace Zenweb\Aventure\ParcBundle\Entity;

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
    private $enabled;

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
     * Set enabled
     *
     * @param boolean $enabled
     * @return Extra
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
    private $parcs;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $typicalDays;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->parcs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->typicalDays = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add parcs
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\Parc $parcs
     * @return Extra
     */
    public function addParc(\Zenweb\Aventure\ParcBundle\Entity\Parc $parcs)
    {
        $this->parcs[] = $parcs;

        return $this;
    }

    /**
     * Remove parcs
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\Parc $parcs
     */
    public function removeParc(\Zenweb\Aventure\ParcBundle\Entity\Parc $parcs)
    {
        $this->parcs->removeElement($parcs);
    }

    /**
     * Get parcs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParcs()
    {
        return $this->parcs;
    }

    /**
     * Add typicalDays
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\TypicalDay $typicalDays
     * @return Extra
     */
    public function addTypicalDay(\Zenweb\Aventure\ParcBundle\Entity\TypicalDay $typicalDays)
    {
        $this->typicalDays[] = $typicalDays;

        return $this;
    }

    /**
     * Remove typicalDays
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\TypicalDay $typicalDays
     */
    public function removeTypicalDay(\Zenweb\Aventure\ParcBundle\Entity\TypicalDay $typicalDays)
    {
        $this->typicalDays->removeElement($typicalDays);
    }

    /**
     * Get typicalDays
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTypicalDays()
    {
        return $this->typicalDays;
    }
}
