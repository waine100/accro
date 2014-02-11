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
        if( $this->determineCurrentStepNumber() > 2)
        {
            $parc = $event->getFormData()->getParc()->getId();
            $date = $event->getFormData()->getBookingDate();
            $em = $this->em->getRepository('ZenwebAventureParcBundle:Booking');
            $event->getFormData()->setBooking($em->findOneBy(array('theDate' => $date, 'parc' => $parc)));
        }
    }

    protected function loadStepsConfig()
    {
        return array(
            array(
                'label' => 'Choose a parc',
                'type' => new CreateOrderParcForm(),
            ),
            array(
                'label' => 'Choose a date',
                'type' => new CreateOrderDateForm(),
            ),
            array(
                'label' => 'Choose your activities.',
                'type' => new CreateOrderActivitiesForm(),
            ),
            array(
                'label' => 'Choose your options.',
                //'type' => new CreateOrderActivitiesForm(),
            ),
            array(
                'label' => 'Choose your customer or create a new one',
                'type' => new CreateOrderUserForm(),
            ),
        );
    }
} 