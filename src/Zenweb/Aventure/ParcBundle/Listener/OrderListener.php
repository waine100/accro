<?php

namespace Zenweb\Aventure\ParcBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;

class OrderListener
{
    public function prePersist(LifecycleEventArgs $args)
    {

        $entity = $args->getEntity();
        $em     = $args->getEntityManager();

        if ($entity instanceof SalesFlatOrder) {
            $tableName = $em->getClassMetadata(get_class($entity))->table['name'];
            $date      = new \DateTime;
            $sql       = sprintf("SELECT count(id) as counter FROM %s WHERE created_at >= '%s' AND reference IS NOT NULL", $tableName, $date->format('Y-m-d'));

            try {
                $statement = $em->getConnection()->query($sql);
                $row       = $statement->fetch();

                $reference = sprintf('%02d%02d%02d%06d',
                    $date->format('y'),
                    $date->format('n'),
                    $date->format('j'),
                    $row['counter'] + 1
                );

                $entity->setReference($reference);

                //To be setted with a nice value
                $entity->setStatus(2);

            } catch (\Exception $e) {
                throw $e;
            }
        }

    }
} 