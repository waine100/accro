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
            $parc = $event->getFormData()->getParc()->getId();
            $date = $event->getFormData()->getBookingDate();
            $em = $this->em->getRepository('ZenwebAventureParcBundle:Booking');
            $event->getFormData()->setBooking($em->findOneBy(array('theDate' => $date, 'parc' => $parc)));
        }

        /**
         * Update the row items total.
         */
        if ($this->determineCurrentStepNumber() > 3 && $event->getStep() == 4) {
            $items = $event->getFormData()->getItems();
            $priceRepo = $this->em->getRepository('ZenwebAventureParcBundle:Price');

            foreach ($items as $item) {
                $rowTotal = 0;
                $minPrice = $priceRepo->getMinPrice($item->getBasePrice()->getId(), $item->getQty());
                $tierPrice = $minPrice->getTierPrices();

                if (!empty($tierPrice[0])) {
                    $rowTotal = $tierPrice[0]->getPrice() * $item->getQty();
                } else {
                    $rowTotal = $item->getBasePrice()->getPrice() * $item->getQty();
                }
                $item->setRowTotal($rowTotal);

                // Set the order link.
                $item->setOrder($event->getFormData());
            }
        }
    }

    protected function loadStepsConfig()
    {
        return array(
            array(
                'label' => 'Choisir un parc',
                'type' => new CreateOrderParcForm(),
            ),
            array(
                'label' => 'Choisir une date',
                'type' => new CreateOrderDateForm(),
            ),
            array(
                'label' => 'Choisir le client',
                'type' => new CreateOrderUserForm(),
            ),
            array(
                'label' => 'Choisir ses activités',
                'type' => new CreateOrderActivitiesForm(),
            ),
            array(
                'label' => 'Choose your options.',
                //'type' => new CreateOrderExtraForm(),
            ),
        );
    }
} 