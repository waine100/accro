<?php

namespace Zenweb\Aventure\ParcBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * BookingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BookingRepository extends EntityRepository
{
    /**
     * Get all entities between 2 dates
     */
    public function getByParcAndDates($beginDate, $endDate, $parcId)
    {
        $qb = $this->createQueryBuilder('a');
        $qb->where('a.theDate BETWEEN :lowLimit AND :highLimit')
            ->setParameter('lowLimit', $beginDate)
            ->setParameter('highLimit', $endDate)
            ->andWhere('a.parc = :parc')
            ->setParameter('parc', $parcId);
        return $qb->getQuery()->getResult();
    }
}