<?php

namespace Zenweb\Aventure\ParcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zenweb\Aventure\ParcBundle\Form\CreateOrder;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class FrontController
 * @package Zenweb\Aventure\ParcBundle\Controller
 */

/**
 * Install:
 * git clone https://github.com/Dorn-/accro.git dossier
 * curl -s https://getcomposer.org/installer | php
 * cd dossier
 * php composer.php update
 * Faire une nouvelle DBB
 * Editer le fichier de conf
 * Vider les caches.
 * Faire un htaccess.
 * Créer un compte admin.
 * Dbb: aventure/ErJ7twRMTd6ZVvCv
 */
class FrontController extends Controller
{
    public function homeAction()
    {
        $session = new Session();
        $formData = new CreateOrder();
        $formPayment = null;
        /** @var $flow \Zenweb\Aventure\ParcBundle\Form\Admin\CreateOrderFlow */
        $flow = $this->get('zenweb_aventure_parc.form.checkout.flow.create.order');
        $flow->bind($formData);

        // form of the current step
        $form = $flow->createForm();

        $parc = 0;
        $typicalDayId = 0;

        $parc = $flow->getFormData()->order->getParc();
        if(!empty($parc)) {
            $parc = $parc->getId();
        }

        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                /**
                 * Set the typical Id.
                 */
                if ($flow->getCurrentStepNumber() == 4) {
                    $date = $flow->getFormData()->order->getBookingDate();
                    if (!empty($date)) {
                        $em = $this->getDoctrine()->getManager()->getRepository('ZenwebAventureParcBundle:Booking');
                        $date = $em->findOneBy(array('theDate' => $date, 'parc' => $parc));
                        $flow->getFormData()->order->setBooking($date);
                    }
                    $session->set('idDate', $date->getId());
                }
                /**
                 * We have choose a date and a parc, get the typicalDayId needed for other purpose.
                 */
                // form for the next step
                $form = $flow->createForm();
            } else {
                // flow finished
                $em = $this->getDoctrine()->getManager();
                $em->persist($formData->order);
                $em->flush();

                $flow->reset(); // remove step data from the session

                return $this->redirect($this->generateUrl('zenweb_aventure_parc_fo_home')); // redirect when done
            }
        }

        $parc = $flow->getFormData()->order->getParc();
        if(!empty($parc)) {
            $parc = $parc->getId();
        }

        $booking = $flow->getFormData()->order->getBooking();
        if (!empty($booking)) {
            $typicalDayId = $flow->getFormData()->order->getBooking()->getTypicalDay()->getId();
        }

        $user = $formData->order->getUser();
        $userId = -1;
        if (!empty($user)) {
            $userId = $formData->order->getUser()->getId();
        }

        return $this->render('ZenwebAventureParcBundle:Checkout:create_order.html.twig', array(
            'form' => $form->createView(),
            'flow' => $flow,
            'parc_id' => $parc,
            'month' => date('m'),
            'year' => date('Y'),
            'userId' => $userId,
            'typicalDayId' => $typicalDayId,
            'user' => $formData->order->getUser(),
            'order' => $flow->getFormData()->order,
            'paymentForm' => $formPayment
        ));
    }

    public function showParcAction($id)
    {
        $parc = $this->getDoctrine()->getManager()->getRepository('ZenwebAventureParcBundle:Parc')->find($id);
        return $this->render('ZenwebAventureParcBundle:Front:show_parc.html.twig', array('parc' => $parc));
    }

    public function menuTopAction($active)
    {
        $parcs = $this->getDoctrine()->getManager()->getRepository('ZenwebAventureParcBundle:Parc')->findByEnabled(true);
        return $this->render('ZenwebAventureParcBundle:Front:menu_top.html.twig', array('parcs' => $parcs, 'active' => $active));
    }

    public function getPricesAction()
    {
        $request = $this->get('request');

        if ($request->isXmlHttpRequest()) {
            // pour vérifier la présence d'une requete Ajax

            $idTimeSlot = $request->request->get('id');
            $userId = $request->request->get('userId');
            $qty = $request->request->get('qty', 1);

            if (null !== $idTimeSlot && null !== $userId) {
                $groupsId = array();
                if ($userId != -1) { //Exist already
                    /**
                     * First get the group of the User
                     */
                    $user = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('ZenwebAventureParcBundle:User')
                        ->find($userId);
                    $groupsId = $user->getGroupsId();
                } else { // New user. Get the default group
                    $groupsId[] = $this->getDoctrine()->getRepository('ZenwebAventureParcBundle:Group')->findOneByName('Particulier')->getId();
                }


                $prices = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ZenwebAventureParcBundle:Price')
                    ->getAvailablePrices($groupsId, $idTimeSlot, $qty);

                $response = new Response();
                $prices = json_encode($prices);
                $response->setStatusCode(200);
                $response->headers->set('Content-Type', 'application/json');
                $response->setContent($prices);
                return $response;
            }
        }

        return new Response("Something wrong happened", 400);
    }

    public function getTimeSlotsAction()
    {
        $request = $this->get('request');

        if ($request->isXmlHttpRequest()) {
            // pour vérifier la présence d'une requete Ajax

            $idActivity = $request->request->get('idActivity');
            $idTypicalDay = $request->request->get('idTypicalDay');
            $idDate = $request->request->get('idDate');

            if (null !== $idActivity && null !== $idTypicalDay && null !== $idDate) {

                $ts = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ZenwebAventureParcBundle:TimeSlot')
                    ->findBy(array('activity' => $idActivity, 'typicalDay' => $idTypicalDay));

                $timeSlots = array();
                foreach ($ts as $t) {
                    $timeSlots[$t->getId()]['name'] = 'de '.$t->getBeginTime()->format("H:i") . ' à ' . $t->getEndTime()->format("H:i");
                    $timeSlots[$t->getId()]['id'] = $t->getId();
                    /**
                     * Check how many places we have left
                     */
                    $placesReserved = $this->getDoctrine()
                                        ->getManager()->getRepository('ZenwebAventureParcBundle:SalesFlatOrder')->getPlacesReserved($idDate, $t->getId());
                    $placesLeft     = $t->getCapacity() - $placesReserved;
                    $placesLeft =  ($placesLeft < 0) ? 0 : $placesLeft;
                    $timeSlots[$t->getId()]['pl'] = $placesLeft;
                }

                $response = new Response();
                $prices = json_encode($timeSlots);
                $response->setStatusCode(200);
                $response->headers->set('Content-Type', 'application/json');
                $response->setContent($prices);
                return $response;
            }
        }

        return new Response("Something wrong happened", 400);
    }

    public function getPricesExtraAction()
    {
        $request = $this->get('request');

        if ($request->isXmlHttpRequest()) {
            // pour vérifier la présence d'une requete Ajax

            $idExtra = $request->request->get('id');
            $qty = $request->request->get('qty', 1);

            if (null !== $idExtra) {
                $price = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ZenwebAventureParcBundle:Extra')
                    ->findOneById($idExtra);

                $response = new Response();
                $price = json_encode($price->getPricePerUnit() * $qty);
                $response->setStatusCode(200);
                $response->headers->set('Content-Type', 'application/json');
                $response->setContent($price);
                return $response;
            }
        }

        return new Response("Something wrong happened", 400);
    }
}
