<?php

namespace Zenweb\Aventure\ParcBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;

class DashboardController extends Controller
{
    public function listAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $parcs =  $manager->getRepository('ZenwebAventureParcBundle:Parc')->findAll();
        return $this->render('ZenwebAventureParcBundle:Dashboard:homepage.html.twig',
            array(
                'admin_pool' => $this->get('sonata.admin.pool'),
                'date' => date("d.m.Y"),
                'parcs' => $parcs
            )
        );
    }

    public function contentAction($parc='',$date='',$activity='',$name='', $ref='', $mail='')
    {
        $name = ($name == 'undefined') ? '' : $name;
        $ref = ($ref == 'undefined') ? '' : $ref;
        $mail = ($mail == 'undefined') ? '' : $mail;
        $activeFilter = ($name == '' && $ref == '' && $mail == '') ? false : true;

        $manager = $this->getDoctrine()->getManager();
        $dateTime = new \DateTime(implode('-',array_reverse(explode('.',$date))));
        $booking =  $manager->getRepository('ZenwebAventureParcBundle:Booking')->findOneBy(array('theDate' => $dateTime, 'parc' => $parc));
        $orders =   $manager->getRepository('ZenwebAventureParcBundle:SalesFlatOrder')->findByBookingDate($dateTime);
        $activities =  $manager->getRepository('ZenwebAventureParcBundle:Activity')->findAll();
        if(is_object($booking)) {
            $this->filterBookingByParameters($orders,$activity,$name,$ref,$mail);
            return $this->render('ZenwebAventureParcBundle:Dashboard:content.html.twig',
                array(
                    'typicalDay' => $booking->getTypicalDay(),
                    'timeSlots'  => $booking->getTypicalDay()->getTimeSlots(),
                    'orders'     => $this->filterBookingByParameters($orders,$activity,$name,$ref,$mail),
                    'nom'        => $name,
                    'ref'        => $ref,
                    'mail'       => $mail,
                    'activeFilter' => $activeFilter,
                    'activities' => $activities,
                    'activitySelected' => $activity
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
        $filterOrders = array();
        foreach ($orders as $order){
            // filtering on activity
            if ($activity == 'all' || $activity == '' || $activity == 'undefined') {
                $filterOrders[] = $order;
            } else {
                foreach ($order->getItems() as $item) {
                    if($item->getActivity()->getId() == $activity) {
                        $filterOrders[] = $order;
                    }
                }
            }
        }
        $orders = $filterOrders;
        $filterOrders = array();
        // filtering on name
        foreach ($orders as $order){
            if ($name == '' || preg_match("/".$name."/i", $order->getUser()->getLastname())) {
                $filterOrders[] = $order;
            }
        }

        $orders = $filterOrders;
        $filterOrders = array();
        // filtering on ref
        foreach ($orders as $order){
            if ($ref == '' || preg_match("/".$ref."/i", $order->getReference())) {
                $filterOrders[] = $order;
            }
        }

        $orders = $filterOrders;
        $filterOrders = array();
        // filtering on mail
        foreach ($orders as $order){
            if ($mail == '' || preg_match("/".$mail."/i", $order->getUser()->getEmail())) {
                $filterOrders[] = $order;
            }
        }

        return $filterOrders;
    }
}
