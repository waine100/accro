<?php

namespace Zenweb\Aventure\ParcBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;

class OrderListener
{
    /**
     * Set a reference and a status before saving an order.
     *
     * @param LifecycleEventArgs $args
     * @throws \Exception
     */
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
                if($entity->getCheckoutMethod() == 'at_arrival') {
                    $entity->setStatus(SalesFlatOrder::STATUS_PAYMENT_ARRIVAL);
                } elseif ($entity->getCheckoutMethod() == 'cb'){
                    $entity->setStatus(SalesFlatOrder::STATUS_PAYMENT_CB_OK);
                } else {
                    $entity->setStatus(SalesFlatOrder::STATUS_STOPPED);
                }

            } catch (\Exception $e) {
                throw $e;
            }
        }

    }
} 