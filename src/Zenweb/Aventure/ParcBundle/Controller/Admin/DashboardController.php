<?php

namespace Zenweb\Aventure\ParcBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function listAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $parcs =  $manager->getRepository('ZenwebAventureParcBundle:Parc')->findAll();
        $activities =  $manager->getRepository('ZenwebAventureParcBundle:Activity')->findAll();
        return $this->render('ZenwebAventureParcBundle:Dashboard:homepage.html.twig',
            array(
                'admin_pool' => $this->get('sonata.admin.pool'),
                'date' => date("d.m.Y"),
                'parcs' => $parcs,
                'activities' => $activities
            )
        );
    }

    public function contentAction($parc='',$date='',$activity='',$name='', $ref='', $mail='')
    {
        if($name == 'undefined') {
            $name = '';
        }
        if($ref == 'undefined') {
            $ref = '';
        }
        if($mail == 'undefined') {
            $mail = '';
        }
        $manager = $this->getDoctrine()->getManager();
        $dateTime = new \DateTime(implode('-',array_reverse(explode('.',$date))));
        $booking =  $manager->getRepository('ZenwebAventureParcBundle:Booking')->findOneBy(array('theDate' => $dateTime, 'parc' => $parc));
        $orders =   $manager->getRepository('ZenwebAventureParcBundle:SalesFlatOrder')->findByBookingDate($dateTime);
        if(is_object($booking)) {
            $this->filterBookingByParameters($orders,$activity,$name,$ref,$mail);
            return $this->render('ZenwebAventureParcBundle:Dashboard:content.html.twig',
                array(
                    'typicalDay' => $booking->getTypicalDay(),
                    'timeSlots'  => $booking->getTypicalDay()->getTimeSlots(),
                    'orders'     => $this->filterBookingByParameters($orders,$activity,$name,$ref,$mail),
                    'nom'        => $name,
                    'ref'        => $ref,
                    'mail'       => $mail
                )
            );
        } else {
            return $this->render('ZenwebAventureParcBundle:Dashboard:content.html.twig',
                array(
                    'error' => 'Journée non définie pour cette date'
                )
            );
        }

    }

    private function filterBookingByParameters($orders, $activity, $name, $ref, $mail) {
        return $orders;
    }
}
