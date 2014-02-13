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

    /**
     * http://stackoverflow.com/questions/8832916/remove-replace-the-username-field-with-email-using-fosuserbundle-in-symfony2
     * @param string $email
     * @return $this|void
     */
    public function setEmail($email)
    {
        parent::setEmail($email);
        $this->setUsername($email);
    }
    /**
     * @var string
     */
    private $mobile;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $commentary;

    /**
     * @var boolean
     */
    private $newsletter;

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return User
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set commentary
     *
     * @param string $commentary
     * @return User
     */
    public function setCommentary($commentary)
    {
        $this->commentary = $commentary;

        return $this;
    }

    /**
     * Get commentary
     *
     * @return string
     */
    public function getCommentary()
    {
        return $this->commentary;
    }

    /**
     * Set newsletter
     *
     * @param boolean $newsletter
     * @return User
     */
    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    /**
     * Get newsletter
     *
     * @return boolean
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }

}
