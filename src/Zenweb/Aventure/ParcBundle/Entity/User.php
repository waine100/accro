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

    public function getGroupsId()
    {
        $groupsId = array();
        foreach ($this->groups as $group) {
            $groupsId[] = $group->getId();
        }
        return $groupsId;
    }

    /**
     * @var \Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder
     */
    private $orders;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $groups;


    /**
     * Set orders
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder $orders
     * @return User
     */
    public function setOrders(\Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder $orders = null)
    {
        $this->orders = $orders;

        return $this;
    }

    /**
     * Get orders
     *
     * @return \Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder 
     */
    public function getOrders()
    {
        return $this->orders;
    }

}
