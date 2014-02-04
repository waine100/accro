<?php

namespace Zenweb\Aventure\ParcBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zenweb\Aventure\ParcBundle\Entity\Orders;

class OrderController extends Controller
{
    public function createOrderAction() {
        $formData = new Orders();

        $flow = $this->get('zenweb_aventure_parc.form.admin.flow.create.order');
        $flow->bind($formData);

        // form of the current step
        $form = $flow->createForm();
        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                // form for the next step
                $form = $flow->createForm();
            } else {
                // flow finished
                $em = $this->getDoctrine()->getManager();
                $em->persist($formData);
                $em->flush();

                $flow->reset(); // remove step data from the session

                return $this->redirect($this->generateUrl('home')); // redirect when done
            }
        }

        return $this->render('ZenwebAventureParcBundle:Admin:create_order.html.twig', array(
            'form' => $form->createView(),
            'flow' => $flow,
        ));
    }
}
