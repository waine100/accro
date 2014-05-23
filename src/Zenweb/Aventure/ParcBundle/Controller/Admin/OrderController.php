<?php

namespace Zenweb\Aventure\ParcBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

//use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;
use Zenweb\Aventure\ParcBundle\Form\CreateOrder;
use Zenweb\Aventure\ParcBundle\Entity\Group;

class OrderController extends Controller
{
    public function createOrderAction()
    {
        $formData = new CreateOrder();

        /** @var $flow \Zenweb\Aventure\ParcBundle\Form\Admin\CreateOrderFlow */
        $flow = $this->get('zenweb_aventure_parc.form.admin.flow.create.order');
        $flow->bind($formData);

        // form of the current step
        $form = $flow->createForm();

        $parc = 0;
        $typicalDayId = 0;

        if ($flow->getCurrentStepNumber() > 1) {
            $parc = $flow->getFormData()->order->getParc()->getId();
        }

        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            /**
             * Needed for calendars
             */
            if ($flow->getCurrentStepNumber() >= 1) {
                $parc = $flow->getFormData()->order->getParc()->getId();
            }

            if ($flow->nextStep()) {
                /**
                 * We have choose a date and a parc, get the typicalDayId needed for other purpose.
                 */

                if ($flow->getCurrentStepNumber() > 2) {
                    $date = $flow->getFormData()->order->getBookingDate();
                    $em   = $this->getDoctrine()->getManager()->getRepository('ZenwebAventureParcBundle:Booking');
                    $flow->getFormData()->order->setBooking($em->findOneBy(array('theDate' => $date, 'parc' => $parc)));
                    $typicalDayId = $flow->getFormData()->order->getBooking()->getTypicalDay()->getId();
                }
                // form for the next step
                $form = $flow->createForm();
            } else {
                // flow finished
                $em = $this->getDoctrine()->getManager();
                $em->persist($formData->order);
                $em->flush();

                $flow->reset(); // remove step data from the session

                return $this->redirect($this->generateUrl('sonata_admin_dashboard')); // redirect when done
            }
        }

        $userId = (!empty($formData->order->getUser()) && !empty($formData->order->getUser()->getId())) ? $formData->order->getUser()->getId() : -1;

        return $this->render('ZenwebAventureParcBundle:Admin:create_order.html.twig', array(
            'form'       => $form->createView(),
            'flow'       => $flow,
            'admin_pool' => $this->get('sonata.admin.pool'),
            'parc_id'    => $parc,
            'month'      => date('m'),
            'year'       => date('Y'),
            'userId'     => $userId,
            'typicalDayId' => $typicalDayId,
            'user'         => $formData->order->getUser(),
            'order'        => $flow->getFormData()->order
        ));
    }

    public function getPricesAction()
    {
        $request = $this->get('request');

        if ($request->isXmlHttpRequest()) {
            // pour vérifier la présence d'une requete Ajax

            $idTimeSlot = $request->request->get('id');
            $userId     = $request->request->get('userId');
            $qty        = $request->request->get('qty', 1);

            if (null !== $idTimeSlot && null !== $userId) {
                $groupsId = array();
                if ($userId != -1) { //Exist already
                    /**
                     * First get the group of the User
                     */
                    $user     = $this->getDoctrine()
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
                $prices   = json_encode($prices);
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

            if (null !== $idActivity && null !== $idTypicalDay) {

                $ts = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ZenwebAventureParcBundle:TimeSlot')
                    ->findBy(array('activity' => $idActivity, 'typicalDay' => $idTypicalDay))
                    ;

                $timeSlots = array();
                foreach($ts as $t) {
                    $timeSlots[$t->getId()]['name'] = $t->getBeginTime()->format("H:i"). ' -> ' . $t->getEndTime()->format("H:i");
                    $timeSlots[$t->getId()]['id'] = $t->getId();
                }

                $response = new Response();
                $prices   = json_encode($timeSlots);
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
            $qty        = $request->request->get('qty', 1);

            if (null !== $idExtra) {
                $price = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ZenwebAventureParcBundle:Extra')
                    ->findOneById($idExtra);

                $response = new Response();
                $price   = json_encode($price->getPricePerUnit() * $qty);
                $response->setStatusCode(200);
                $response->headers->set('Content-Type', 'application/json');
                $response->setContent($price);
                return $response;
            }
        }

        return new Response("Something wrong happened", 400);
    }
}
