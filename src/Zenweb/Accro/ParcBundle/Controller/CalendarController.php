<?php

namespace Zenweb\Accro\ParcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CalendarController extends Controller
{
    public function calendarDisplayAction($admin) //$admin is a boolean parameter defined in routing.yml set at true for the admin page and false otherwise
    {
        $em = $this->getDoctrine()->getManager();

        $date  = new \DateTime();
        $year  = $date->format('Y'); //to start calendar on current year
        $month = $date->format('m'); //to start calendar on current month
        $day   = $date->format('d');

        $items = $em->getRepository('DpCalendarBundle:Item')->findBy(array(), array('position' => 'ASC')); //all items followed with the calendar

        $item = $em->getRepository('DpCalendarBundle:Item')->findOneBy(array(), array('position' => 'ASC'), 1, 1)->getId(); //first item on which calendar will open

        $states = $em->getRepository('DpCalendarBundle:State')->findBy(array(), array('position' => 'ASC')); //all booking states for the legend

        $typicalDays = $em->getRepository('ZenwebAccroParcBundle:TypicalDay')->findBy(array(), array('name' => 'ASC')); //all typical days

        return $this->render('ZenwebAccroParcBundle:Admin:calendar.html.twig', array(
            'year'   => $year,
            'month'  => $month,
            'day'    => $day,
            'admin'  => $admin,
            'items'  => $items,
            'item'   => $item,
            'states' => $states,
            'typicalDays' => $typicalDays,
        ));
    }
}
