<?php
/**
 * Created by PhpStorm.
 * User: Rogal
 * Date: 16/02/14
 * Time: 19:27
 */

namespace Zenweb\Aventure\ParcBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;

class ActivityQuantityValidator extends ConstraintValidator {

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em      = $em;
    }

    public function validate($item, Constraint $constraint)
    {
        $qtyWanted = $item->getQty();
        $qtyMax = $item->getTimeSlot()->getActivity()->getCapacity();
        $qtyMin = $item->getTimeSlot()->getActivity()->getQtyMin();
        $tsId = $item->getTimeSlot()->getId();

        $activity = $item->getTimeSlot()->getActivity();
        $timeSlot = $item->getTimeSlot();

        /**
         * @todo
         * LA DATE EST PAS BONNE. IL FAUT STOCKER LA DATE QUELQUEPART ABSOLUMENT
         * AUTRE PB n'est pas bon si plusieurs items sur le même timeslot
         * AUTRE PB Me souviens plus mais il y a un truc.
         */
        $date = $item->getTimeSlot()->getBeginTime();

        if($qtyWanted > $qtyMax) {
            $this->context->addViolation($constraint->tooMuchMessage, array('{{ max }}' => $qtyMax, '{{ timeSlot }}' => $timeSlot, '{{ activity }}' => $activity));
            return;
        }

        if($qtyWanted < $qtyMin) {
            $this->context->addViolation($constraint->tooLessMessage, array('{{ min }}' => $qtyMin, '{{ timeSlot }}' => $timeSlot, '{{ activity }}' => $activity));
            return;
        }

        /**
         * Check how many places we have left
         */
        $placesReserved = $this->em->getRepository('ZenwebAventureParcBundle:SalesFlatOrder')->getPlacesReserved($date, $tsId);
        $placesLeft = $qtyMax - $placesReserved;

        if($placesLeft < 0) {
            $this->context->addViolation($constraint->message, array('{{ limit }}' => $placesLeft, '{{ timeSlot }}' => $timeSlot, '{{ activity }}' => $activity));
            return;
        }

    }
} 