<?php
/**
 * Created by PhpStorm.
 * User: Rogal
 * Date: 04/02/14
 * Time: 21:19
 */
namespace Zenweb\Aventure\ParcBundle\Form\Admin;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Event\PostBindSavedDataEvent;
use Craue\FormFlowBundle\Form\FormFlowInterface;
use Craue\FormFlowBundle\Form\FormFlowEvents;

use Doctrine\ORM\EntityManager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CreateOrderFlow extends FormFlow implements EventSubscriberInterface
{

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
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
        );
    }

    public function onPostBindSavedData(PostBindSavedDataEvent $event)
    {
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
        if ($this->determineCurrentStepNumber() > 5 && $event->getStep() == 6) {
            $items     = $event->getFormData()->order->getItems();
            $priceRepo = $this->em->getRepository('ZenwebAventureParcBundle:Price');

            foreach ($items as $item) {
                $rowTotal  = 0;
                $minPrice  = $priceRepo->getMinPrice($item->getBasePrice()->getId(), $item->getQty());
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

        if ($this->determineCurrentStepNumber() > 6 && $event->getStep() == 7) {
            $items     = $event->getFormData()->order->getExtras();

            foreach ($items as $item) {
                $item->setOrder($event->getFormData()->order);
                $item->setRowTotal(7*$item->getQty());
            }
        }
    }

    protected function loadStepsConfig()
    {
        return array(
            array(
                'label' => 'Choisir un parc',
                'type'  => new CreateOrderParcForm(),
            ),
            array(
                'label' => 'Choisir une date',
                'type'  => new CreateOrderDateForm(),
            ),
            array(
                'label' => 'Client',
                'type'  => new CreateOrderUserForm(),
            ),
            array(
                'label' => 'Choisir le client',
                'type'  => new CreateOrderChooseUserForm(),
                'skip'  => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                        return $estimatedCurrentStepNumber > 3 && $flow->getFormData()->addUser;
                    },
            ),
            array(
                'label' => 'Créer un client',
                'type'  => new CreateOrderCreateUserForm(),
                'skip'  => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                        return $estimatedCurrentStepNumber > 3 && !$flow->getFormData()->addUser;
                    },
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
                //'type' => new CreateOrderExtraForm(),
            ),
        );
    }
} 