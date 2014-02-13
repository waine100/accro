<?php
/**
 * Created by PhpStorm.
 * User: Rogal
 * Date: 13/02/14
 * Time: 22:45
 */

namespace Zenweb\Aventure\ParcBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityManager;

//http://stackoverflow.com/questions/15332071/adding-new-fosuserbundle-users-to-a-default-group-on-creation

class UserCreationListener {
    protected $em;
    protected $user;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        );
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        $this->user = $event->getForm()->getData();
        $group_name = 'Particulier';
        $entity = $this->em->getRepository('ZenwebAventureParcBundle:Group')->findOneByName($group_name);
        $this->user->addGroup($entity);
        $this->em->flush();

    }
} 