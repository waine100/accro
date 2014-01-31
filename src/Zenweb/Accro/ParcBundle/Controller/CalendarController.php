<?php

namespace Zenweb\Accro\ParcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Zenweb\Accro\ParcBundle\Entity\Booking;

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

        $parcs = $em->getRepository('ZenwebAccroParcBundle:Parc')->findBy(array(), array('name' => 'ASC')); //all booking states for the legend

        $typicalDays = $em->getRepository('ZenwebAccroParcBundle:TypicalDay')->findBy(array(), array('name' => 'ASC')); //all typical days

        return $this->render('ZenwebAccroParcBundle:Admin:calendar.html.twig', array(
            'year'        => $year,
            'month'       => $month,
            'day'         => $day,
            'admin'       => $admin,
            'items'       => $items,
            'item'        => $item,
            'parcs'       => $parcs,
            'typicalDays' => $typicalDays,
        ));
    }

    public function ajaxAdminAction() //controller called via ajax when a date is clicked on administration panel
    {
        $em = $this->getDoctrine()->getManager();

        /**
         * Get all params
         */
        $request      = $this->get('request');
        $date         = $request->request->get('date');
        $dateId       = $request->request->get('id');
        $parcId       = $request->request->get('parcId');
        $typicalDayId = $request->request->get('typicalDay');

        /**
         * Check that the parc and typical day really exists.
         */
        $parc = $em->getRepository('ZenwebAccroParcBundle:Parc')->find($parcId);
        if (!$parc) {
            // Can't find the parc, something is kinda wrong, or this is the first initialization
            $return = '{"responseCode" : "400", "message" : "Something went wrong, it was impossible to find the parc of id: ' . $parcId . '"}';
            return new Response($return, 200, array('Content-Type' => 'application/json'));
        }

        $typicalDay = $em->getRepository('ZenwebAccroParcBundle:TypicalDay')->find($typicalDayId);
        if (!$typicalDay) {
            $return = '{"responseCode" : "400", "message" : "Something went wrong, it was impossible to find the typical day of id: ' . $typicalDayId . '"}'; // if  the state selected is not found, an ajax response is sent with a message to be displayed
            return new Response($return, 200, array('Content-Type' => 'application/json'));
        }


        /**
         * Forge the date selected
         */
        $yearKey    = substr($date, 0, 4);
        $monthKey   = substr($date, 5, 2);
        $dayKey     = substr($date, 8, 2);
        $dateWanted = new \DateTime();
        $dateWanted->setDate($yearKey, $monthKey, $dayKey);
        $dateWanted->setTime(0, 0, 0);


        /**
         * Get the element if it exists
         *
         * @var $bookingRepo Zenweb\Accro\ParcBundle\Entity\BookingRepository
         */
        $bookingRepo = $em->getRepository('ZenwebAccroParcBundle:Booking');
        $booking     = $bookingRepo->findOneBy(array('theDate' => $dateWanted, 'parc' => $parcId));

        $return = '';

        $return .= '"id_returned" : "' . $dateId . '" , ';
        $return .= '"date_returned" : "' . $date . '" , ';

        if (null === $booking) {
            $booking = new Booking();
            $booking->setTheDate($dateWanted);
            $booking->setParc($parc);
            $booking->setTypicalDay($typicalDay);
            $em->persist($booking);
            $em->flush();
            $return .= '"state" : "' . $booking->getTypicalDay()->getColor() . '" }';
        } else { //Update it
            $booking->setTypicalDay($typicalDay);
            $em->persist($booking);
            $em->flush();
            $return .= '"state" : "' . $booking->getTypicalDay()->getColor() . '" }';
        }

        $return = '{"responseCode" : "200", ' . $return;

        return new Response($return, 200, array('Content-Type' => 'application/json')); //make sure it has the correct content type
    }

    public function loadAction() //controller called via ajax to fill calendar for a specific month, year and item
    {
        $oneday = new \DateInterval('P1D');

        $em = $this->getDoctrine()->getManager();

        $request  = $this->get('request');
        $yearKey  = intval($request->request->get('year'));
        $monthKey = intval($request->request->get('month'));
        $parcId   = intval($request->request->get('parcId'));
        if ($monthKey == 0) $monthKey = 12;

        $parc = $em->getRepository('ZenwebAccroParcBundle:Parc')->find($parcId);
        if (!$parc) {
            $return = '{"responseCode" : "400", "message" : "the parc selected does not exist - please restart the application"}'; // if  the item is not found, an ajax response is sent with a message to be displayed
            return new Response($return, 200, array('Content-Type' => 'application/json'));
        }

        $lowLimit  = new \DateTime(); //low limit date used to select dates in the booking table
        $highLimit = new \DateTime(); //high limit date used to select dates in the booking table
        $lowLimit->setDate($yearKey, $monthKey, 1);
        $lowLimit->sub($oneday);
        $highLimit->setDate($yearKey, $monthKey, 31);
        $highLimit->add($oneday);

        $er       = $em->getRepository('ZenwebAccroParcBundle:Booking');
        $entities = $er->getByParcAndDates($lowLimit, $highLimit, $parcId);
        $bookings = array();
        foreach ($entities as $booking) {
            $key            = $booking->getTheDate()->format('Y-m-d');
            $bookings[$key] = $booking->getTypicalDay()->getColor(); //for each date found in the query, class to be applied is stored in array $bookings()
        }

        $return = '';

        $current_month = $this->getMonth($monthKey);
        $title         = htmlentities($current_month . " " . $yearKey, ENT_QUOTES);
        $return .= '"current_month" : "' . $title . '" , ';

        $previous_month      = $this->getOtherMonth($monthKey, $yearKey, -1); //needed to calculate the number of days of previous month
        $days_previous_month = date('t', mktime(0, 0, 0, $previous_month[$monthKey], 1, $previous_month[$yearKey])); //number of days of the previous month, used to populate the calendar cells corresponding to the previous month.
        $return .= '"days_previous_month" : "' . $days_previous_month . '" , ';

        //The following 4 arrays will contain all the information for each cell of the calendar table.
        $tab_days   = array();
        $tab_booked = array();
        $tab_class  = array();
        $tab_dates  = array();

        $num_day         = $this->getFirstDay($monthKey, $yearKey);
        $count           = 1;
        $num_day_current = 1;
        $nb_days_prev    = 0;

        while ($count < 43) {
            if ($count < $num_day) {
                $nb_days_prev++; //counts the number of days of previous month appearing on a calendar.
                $tab_days[$count]   = 0;
                $tab_booked[$count] = -1;
                $tab_class[$count]  = ""; //only actual days of the targeted month will have their class stored here
                $tab_dates[$count]  = ""; //only actual days of the targeted month will have their date stored here
            } else {
                if (checkdate($monthKey, $num_day_current, $yearKey)) //if the date is valid
                {
                    $datetime          = new \DateTime();
                    $date              = $datetime->setDate($yearKey, $monthKey, $num_day_current)->format('Y-m-d');
                    $tab_dates[$count] = $date;
                    if (array_key_exists($date, $bookings)) //if the date has been found in the booking table for the targeted item
                    {
                        $tab_days[$count]   = $num_day_current;
                        $tab_booked[$count] = 1;
                        $tab_class[$count]  = $bookings[$date];
                    } else {
                        $tab_days[$count]   = $num_day_current;
                        $tab_booked[$count] = 0;
                        $tab_class[$count]  = ""; //if the date has not been found in the booking table for the targeted item, then we apply the class of the first state
                    }

                    $num_day_current++;

                } else {
                    $tab_days[$count]   = $count - $num_day_current - $nb_days_prev + 1; //used to display the days of the next month displayed on the calendar
                    $tab_booked[$count] = -2;
                    $tab_class[$count]  = "";
                    $tab_dates[$count]  = "";
                }

            }
            $count++;
        }

        $return .= '"nb_days_prev" : "' . $nb_days_prev . '" , ';

        //now starts the actual building of the JSON response
        if (!empty($tab_days)) {
            $return .= ' "calendar" : [ ';
            $count = 1;
            while ($count < 43) {
                if ($count == 42) {
                    $return .= ' { "fill" : "' . $tab_days[$count] . '", "booked" : "' . $tab_booked[$count] . '", "classe" : "' . $tab_class[$count] . '", "dates" : "' . $tab_dates[$count] . '" } ';
                } else {
                    $return .= ' { "fill" : "' . $tab_days[$count] . '", "booked" : "' . $tab_booked[$count] . '", "classe" : "' . $tab_class[$count] . '", "dates" : "' . $tab_dates[$count] . '" } , ';
                }
                $count++;
            }
            $return .= ' ] ';
        }
        $return .= ' } ';
        $return = '{"responseCode" : "200", ' . $return;

        return new Response($return, 200, array('Content-Type' => 'application/json')); //make sure it has the correct content type
    }


    /**
     * TODO MOVE TO HELPER
     *
     */



    
    //Function returning the name of the month based on its number - accents are javascript encoded
    function getMonth($monthKey)
    {
        $monthKey = sprintf("%d", $monthKey);
        $tab_mois = array(1 => "Janvier", "F\351vrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Ao\373t", "Septembre", "Octobre", "Novembre", "D\351cembre");
        return $tab_mois[$monthKey];
    }

    //Function returning following or previous month and year based on $pas
    function getOtherMonth($monthKey, $yearKey, $pas)
    {
        $tmstp_suivant            = mktime(0, 0, 0, ($monthKey + $pas), 1, $yearKey);
        $date_suivante[$monthKey] = date("m", $tmstp_suivant);
        $date_suivante[$yearKey]  = date("Y", $tmstp_suivant);
        return $date_suivante;
    }

    //Function returning the first day of the month
    function getFirstDay($monthKey, $yearKey)
    {
        $tmstp  = mktime(0, 0, 0, $monthKey, 1, $yearKey);
        $dayKey = date("w", $tmstp);

        $tab_jour = array(0 => 7, 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6); //This is for calendars with weeks starting on Mondays. Sunday returns a 0 which must be changed to 7

        return $tab_jour[$dayKey]; //for calendars with weeks starting on Sundays, just return $dayKey.
    }
}
