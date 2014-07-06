<?php

namespace Zenweb\Aventure\ParcBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Zenweb\Aventure\ParcBundle\Entity\User;

class UserListener
{
    /**
     * ADD the user group Particulier if no groups have been affected.
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {

        $entity = $args->getEntity();
        $em     = $args->getEntityManager();

        if ($entity instanceof User) {
            if (!$entity->getGroups()->count()) {
                $group = $em->getRepository('ZenwebAventureParcBundle:Group')->findOneByName('Particulier');
                $entity->addGroup($group);
            }
        }
    }


} 