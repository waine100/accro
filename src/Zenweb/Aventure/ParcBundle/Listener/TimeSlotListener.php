<?php

namespace Zenweb\Aventure\ParcBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Zenweb\Aventure\ParcBundle\Entity\TimeSlot;

class TimeSlotListener
{
    /**
     * If nothing is set in the timeslot capacity take the activity capacity
     * @param LifecycleEventArgs $args
     *
     * @throws \Exception
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        /** @var Zenweb\Aventure\ParcBundle\Entity\TimeSlot $entity */
        $entity = $args->getEntity();

        if ($entity instanceof TimeSlot) {

            try {
                $qty = $entity->getCapacity();
                if (empty($qty)) {
                    $entity->setCapacity($entity->getActivity()->getCapacity());
                }

            } catch (\Exception $e) {
                throw $e;
            }
        }

    }
} 