<?php

namespace Zenweb\Aventure\ParcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SalesFlatOrder
 */
class SalesFlatOrder
{
    const STATUS_OPEN = 0; // created but not validated
    const STATUS_PENDING = 1; // waiting from action from the user
    const STATUS_VALIDATED = 2; // the order is validated does not mean the payment is ok
    const STATUS_CANCELLED = 3; // the order is cancelled
    const STATUS_ERROR = 4; // the order has an error
    const STATUS_STOPPED = 5; // use if the subscription has been cancelled/stopped
    const STATUS_PAYMENT_ARRIVAL = 6; // use if the user choose to pay on arrival at site
    const STATUS_PAYMENT_CB_OK = 7; // use if the user has paid in CB ans return code from bank is ok
    const STATUS_PAYMENT_CB_KO = 8; // use if the user has paid in CB ans return code from bank is ko

    /**
     * @var string $reference
     */
    protected $reference;

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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
        //return $this->bookingDate->format('Y-m-d');
    }

    /**
     * Set checkoutMethod
     *
     * @param string $checkoutMethod
     *
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
     *
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
     *
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

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $items;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $extras;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setStatus(SalesFlatOrder::STATUS_OPEN);
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
        $this->extras = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add items
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\SalesFlatItem $items
     *
     * @return SalesFlatOrder
     */
    public function addItem(\Zenweb\Aventure\ParcBundle\Entity\SalesFlatItem $items)
    {
        $items->setOrder($this);
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\SalesFlatItem $items
     */
    public function removeItem(\Zenweb\Aventure\ParcBundle\Entity\SalesFlatItem $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->items;
    }

    private $booking;

    /**
     * @param mixed $booking
     */
    public function setBooking($booking)
    {
        $this->booking = $booking;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBooking()
    {
        return $this->booking;
    }


    /**
     * @var \Zenweb\Aventure\ParcBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\User $user
     *
     * @return SalesFlatOrder
     */
    public function setUser(\Zenweb\Aventure\ParcBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Zenweb\Aventure\ParcBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    /**
     * Calculate order total based on its items
     */
    public function calculateTotal()
    {
        $orderTotal = 0;
        foreach ($this->items as $item) {
            $orderTotal += $item->getRowTotal();
        }
        foreach ($this->extras as $item) {
            $orderTotal += $item->getRowTotal();
        }
        $this->setBaseTotal($orderTotal);
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return $this->getReference() ? : 'n/a';
    }

    /**
     * {@inheritdoc}
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * {@inheritdoc}
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return string
     */
    public function getStatusName()
    {
        $statusList = self::getStatusList();

        return $statusList[$this->getStatus()];
    }

    /**
     * @static
     * @return array
     */
    public static function getStatusList()
    {
        return array(
            self::STATUS_OPEN               => 'status_open',
            self::STATUS_PENDING            => 'status_pending',
            self::STATUS_VALIDATED          => 'status_validated',
            self::STATUS_CANCELLED          => 'status_cancelled',
            self::STATUS_ERROR              => 'status_error',
            self::STATUS_STOPPED            => 'status_stopped',
            self::STATUS_PAYMENT_ARRIVAL    => 'status_payment_arrival',
            self::STATUS_PAYMENT_CB_OK      => 'status_payment_ok',
            self::STATUS_PAYMENT_CB_KO      => 'status_payment_ko',
        );
    }

    /**
     * @static
     * @return array
     */
    public static function getStatusHtmlTraduction()
    {
        return array(
            self::STATUS_OPEN               => '<span class="label label-warning">Commande ouverte</span>',
            self::STATUS_PENDING            => '<span class="label label-default">Commande bloquée</span>',
            self::STATUS_VALIDATED          => '<span class="label label-success">Commande validée</span>',
            self::STATUS_CANCELLED          => '<span class="label label-danger">Commande annulée</span>',
            self::STATUS_ERROR              => '<span class="label label-danger">Commande en erreur</span>',
            self::STATUS_STOPPED            => '<span class="label label-danger">Commande stoppée</span>',
            self::STATUS_PAYMENT_ARRIVAL    => '<span class="label label-info">Paiement à l\'arrivée</span>',
            self::STATUS_PAYMENT_CB_OK      => '<span class="label label-success">Paiement CB OK</span>',
            self::STATUS_PAYMENT_CB_KO      => '<span class="label label-danger">Paiement CB KO</span>',
        );
    }

    /**
     * Add items
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\SalesFlatItem $items
     *
     * @return SalesFlatOrder
     */
    public function addExtra(\Zenweb\Aventure\ParcBundle\Entity\SalesFlatExtra $extras)
    {
        $extras->setOrder($this);
        $this->extras[] = $extras;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \Zenweb\Aventure\ParcBundle\Entity\SalesFlatItem $items
     */
    public function removeExtra(\Zenweb\Aventure\ParcBundle\Entity\SalesFlatExtra $extras)
    {
        $this->extras->removeElement($extras);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExtras()
    {
        return $this->extras;
    }
}
