<?php

namespace Zenweb\Aventure\ParcBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;

class OrderController extends Controller
{
    public function createOrderAction()
    {
        $formData = new SalesFlatOrder();

        /** @var $flow \Zenweb\Aventure\ParcBundle\Form\Admin\CreateOrderFlow */
        $flow = $this->get('zenweb_aventure_parc.form.admin.flow.create.order');
        $flow->bind($formData);

        // form of the current step
        $form = $flow->createForm();

        $parc = 0;

        if ($flow->getCurrentStepNumber() > 1) {
            $parc = $flow->getFormData()->getParc()->getId();
        }

        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            /**
             * Needed for calendars
             */
            if ($flow->getCurrentStepNumber() >= 1) {
                $parc = $flow->getFormData()->getParc()->getId();
            }

            if ($flow->nextStep()) {
                /**
                 * We have choose a date and a parc, get the typicalDayId needed for other purpose.
                 */

                if ($flow->getCurrentStepNumber() > 2) {
                    $date = $flow->getFormData()->getBookingDate();
                    $em   = $this->getDoctrine()->getManager()->getRepository('ZenwebAventureParcBundle:Booking');
                    $flow->getFormData()->setBooking($em->findOneBy(array('theDate' => $date, 'parc' => $parc)));
                }
                // form for the next step
                $form = $flow->createForm();
            } else {
                // flow finished
                $em = $this->getDoctrine()->getManager();
                $em->persist($formData);
                $em->flush();

                $flow->reset(); // remove step data from the session

                return $this->redirect($this->generateUrl('sonata_admin_dashboard')); // redirect when done
            }
        }

        $userId = !empty($formData->getUser()) ? $formData->getUser()->getId(): null;

        return $this->render('ZenwebAventureParcBundle:Admin:create_order.html.twig', array(
            'form'       => $form->createView(),
            'flow'       => $flow,
            'admin_pool' => $this->get('sonata.admin.pool'),
            'parc_id'    => $parc,
            'month'      => date('m'),
            'year'       => date('Y'),
            'userId'     => $userId,
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
                /**
                 * First get the group of the User
                 */
                $user = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ZenwebAventureParcBundle:User')
                    ->find($userId)
                    ;

                $prices = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('ZenwebAventureParcBundle:Price')
                    ->getAvailablePrices($user->getGroupsId(), $idTimeSlot, $qty);

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
}
