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

class ActivityQuantityValidator extends ConstraintValidator
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function validate($order, Constraint $constraint)
    {
        $date = $order->getBookingDate();

        $placesWanted = array();

        foreach ($order->getItems() as $item) {
            $qtyWanted = $item->getQty();
            $qtyMax    = $item->getTimeSlot()->getCapacity();
            $qtyMin    = $item->getTimeSlot()->getActivity()->getQtyMin();
            $tsId      = $item->getTimeSlot()->getId();

            $activity = $item->getTimeSlot()->getActivity();
            $timeSlot = $item->getTimeSlot();

            if (isset($placesWanted[$tsId])) {
                $placesWanted[$tsId] += $qtyWanted;
            } else {
                $placesWanted[$tsId] = $qtyWanted;
            }


            if ($qtyWanted > $qtyMax) {
                $this->context->addViolation($constraint->tooMuchMessage, array('{{ max }}' => $qtyMax, '{{ timeSlot }}' => $timeSlot, '{{ activity }}' => $activity));
            }

            if ($qtyWanted < $qtyMin) {
                $this->context->addViolation($constraint->tooLessMessage, array('{{ min }}' => $qtyMin, '{{ timeSlot }}' => $timeSlot, '{{ activity }}' => $activity));
            }

            /**
             * Check how many places we have left
             */
            $placesReserved = $this->em->getRepository('ZenwebAventureParcBundle:SalesFlatOrder')->getPlacesReserved($date, $tsId);
            $placesLeft     = $qtyMax - $placesReserved - $placesWanted[$tsId];

            if ($placesLeft < 0) {
                $this->context->addViolation($constraint->message, array('{{ limit }}' => $placesLeft, '{{ timeSlot }}' => $timeSlot, '{{ activity }}' => $activity));
            }
        }
    }
} 