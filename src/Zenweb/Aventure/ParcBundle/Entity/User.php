<?php
namespace Zenweb\Aventure\ParcBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;

class User extends BaseUser
{
    protected $id;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * @var \Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder
     */
    private $flat_order;


    /**
     * Set flat_order
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder $flatOrder
     * @return User
     */
    public function setFlatOrder(\Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder $flatOrder = null)
    {
        $this->flat_order = $flatOrder;

        return $this;
    }

    /**
     * Get flat_order
     *
     * @return \Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder 
     */
    public function getFlatOrder()
    {
        return $this->flat_order;
    }
}
