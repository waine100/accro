<?php

namespace Zenweb\Aventure\ParcBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TimeSlotRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TimeSlotRepository extends EntityRepository
{
    public function getTsByParcAndDate($parc, $date)
    {
        $query = $this->_em->createQuery("select ts from ZenwebAventureParcBundle:TimeSlot ts join ts.typicalDay td join ZenwebAventureParcBundle:Booking b with b.typicalDay=td.id where b.parc = :parc and b.theDate = :date");
        $query->setParameters(array('parc' => $parc, 'date' => $date));
        return $query->getResult();
    }
}
