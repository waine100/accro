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

        $parc         = 0;
        $typicalDayId = 0;

        if ($flow->getCurrentStepNumber() > 1) {
            $parc = $flow->getFormData()->order->getParc()->getId();
        }

        /**
         * We have choose a date and a parc, get the typicalDayId needed for other purpose.
         */

        if ($flow->getCurrentStepNumber() > 2) {
            $date = $flow->getFormData()->order->getBookingDate();
            $em   = $this->getDoctrine()->getManager()->getRepository('ZenwebAventureParcBundle:Booking');
            $flow->getFormData()->order->setBooking($em->findOneBy(array('theDate' => $date, 'parc' => $parc)));
            $typicalDayId = $flow->getFormData()->order->getBooking()->getTypicalDay()->getId();
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
                // form for the next step
                $form = $flow->createForm();
            } else {
                // flow finished

                /**
                 * At this time the base Price is an id. We need the object
                 * Use it.
                 */
                $items = $formData->order->getItems();
                foreach ($items as $item) {
                    $item->setBasePrice($this->getDoctrine()->getManager()->getRepository('ZenwebAventureParcBundle:Price')->find($item->getBasePrice()));
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($formData->order);
                $em->flush();

                $priceToPaid    = $flow->getFormData()->order->getBaseTotal();
                $checkoutMethod = $flow->getFormData()->order->getCheckoutMethod();
                $flow->reset(); // remove step data from the session

                if ($checkoutMethod == 'cb') {
                    return $this->redirect($this->generateUrl('zenweb_aventure_parc_payment', array('price' => $priceToPaid))); // redirect when done
                } else {
                    return $this->redirect($this->generateUrl('sonata_admin_dashboard')); // redirect when done
                }

            }
        }

        $userId = (!empty($formData->order->getUser()) && !empty($formData->order->getUser()->getId())) ? $formData->order->getUser()->getId() : -1;

        return $this->render('ZenwebAventureParcBundle:Admin:create_order.html.twig', array(
            'form'         => $form->createView(),
            'flow'         => $flow,
            'admin_pool'   => $this->get('sonata.admin.pool'),
            'parc_id'      => $parc,
            'month'        => date('m'),
            'year'         => date('Y'),
            'userId'       => $userId,
            'typicalDayId' => $typicalDayId,
            'user'         => $formData->order->getUser(),
            'order'        => $flow->getFormData()->order
        ));
    }


}
