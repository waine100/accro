<?php
/**
 * Created by PhpStorm.
 * User: Rogal
 * Date: 04/02/14
 * Time: 21:19
 */
namespace Zenweb\Aventure\ParcBundle\Form\Checkout;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Event\PostBindSavedDataEvent;
use Craue\FormFlowBundle\Event\PreBindEvent;
use Craue\FormFlowBundle\Form\FormFlowInterface;
use Craue\FormFlowBundle\Form\FormFlowEvents;

use Doctrine\ORM\EntityManager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;
use FOS\UserBundle\Model\UserInterface;

class CreateOrderFlow extends FormFlow implements EventSubscriberInterface
{

    public function __construct(EntityManager $em, $securityContext)
    {
        $this->em = $em;
        $this->securityContext = $securityContext;
    }

    public function getName()
    {
        return 'createOrder';
    }

    public function setEventDispatcher(EventDispatcherInterface $dispatcher)
    {
        parent::setEventDispatcher($dispatcher);
        $dispatcher->addSubscriber($this);
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormFlowEvents::POST_BIND_SAVED_DATA => 'onPostBindSavedData',

            FormFlowEvents::PRE_BIND => 'onPreBind',
        );
    }

    public function onPreBind(PreBindEvent $event)
    {
        $event->getFlow()->skipUser = false;
        $user = $this->securityContext->getToken()->getUser();
        if ($user instanceof UserInterface) {
            $event->getFlow()->skipUser = true;
        }
    }

    public function onPostBindSavedData(PostBindSavedDataEvent $event)
    {
        $totalOrder = 0;

        /**
         * Set logged user as order user
         */
        $user = $this->securityContext->getToken()->getUser();
        if ($user instanceof UserInterface) {
            $event->getFormData()->order->setUser($user);
        }

        /**
         * @todo populate here the booking var if possible
         *  if( $this->determineCurrentStepNumber() > 2) ...
         */
        if ($this->determineCurrentStepNumber() > 2 && $event->getStep() == 3) {
            $parc = $event->getFormData()->order->getParc()->getId();
            $date = $event->getFormData()->order->getBookingDate();
            $em   = $this->em->getRepository('ZenwebAventureParcBundle:Booking');
            $event->getFormData()->order->setBooking($em->findOneBy(array('theDate' => $date, 'parc' => $parc)));
        }

        /**
         * Update the row items total.
         */
        if ($this->determineCurrentStepNumber() > 3 && $event->getStep() == 4) {
            $items     = $event->getFormData()->order->getItems();
            $priceRepo = $this->em->getRepository('ZenwebAventureParcBundle:Price');

            foreach ($items as $item) {
                $rowTotal  = 0;
                $minPrice  = $priceRepo->getMinPrice($item->getBasePrice(), $item->getQty());
                $tierPrice = $minPrice->getTierPrices();

                if (!empty($tierPrice[0])) {
                    $rowTotal = $tierPrice[0]->getPrice() * $item->getQty();
                } else {
                    $rowTotal = $item->getBasePrice()->getPrice() * $item->getQty();
                }
                $item->setRowTotal($rowTotal);

                // Set the order link.
                $item->setOrder($event->getFormData()->order);
            }
        }

        if ($this->determineCurrentStepNumber() > 4 && $event->getStep() == 5) {
            $items     = $event->getFormData()->order->getExtras();

            foreach ($items as $item) {
                $item->setOrder($event->getFormData()->order);
                $rowTotal=$item->getQty()*$item->getName()->getPricePerUnit();
                $item->setRowTotal($rowTotal);
            }
        }

        if ($this->determineCurrentStepNumber() > 5) {
            $event->getFormData()->order->setCheckoutMethod($event->getFormData()->order->getCheckoutMethod());
        }

    }

    public function onGetSteps(GetStepsEvent $event) {
        if($event->getStep() == 6) {
            $event->getFormData()->order->setStatus(SalesFlatOrder::STATUS_PENDING);
        } else {
            $event->getFormData()->order->setStatus(SalesFlatOrder::STATUS_ERROR);
        }
    }

    protected function loadStepsConfig()
    {
        return array(
            array(
                'label' => 'Identification',
                'type'  => new CreateOrderCreateUserForm(),
                /**
                 * Attention le skip change le nombre d'étapes et donc le workflow peut être impacté.
                 * A voir comment régler ce problème.
                 */
                'skip'  => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                        return $flow->skipUser;
                    },
            ),
            array(
                'label' => 'Choisir un parc',
                'type'  => new CreateOrderParcForm(),
            ),
            array(
                'label' => 'Choisir une date',
                'type'  => new CreateOrderDateForm(),
            ),
            array(
                'label' => 'Choisir ses activités',
                'type'  => new CreateOrderActivitiesForm(),
            ),
            array(
                'label' => 'Choisir ses options',
                'type' => new CreateOrderExtraForm(),
            ),
            array(
                'label' => 'Récapitualtif de commande',
                'type' => new CreateOrderRecapForm(),
            ),
            array(
                'label' => 'Paiement',
                'type' => new CreateOrderPaymentForm(),
            ),
        );
    }
} 