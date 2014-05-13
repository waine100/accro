<?php

namespace Zenweb\Aventure\UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\FOSUserEvents;

class OrdersController extends Controller
{
    public function indexAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }
        //Get user orders:
        $em = $this->getDoctrine()->getManager();
        $orders = $em->getRepository('ZenwebAventureParcBundle:SalesFlatOrder')->findBy(array('user' => $user->getId()));

        return $this->render('SonataUserBundle:Profile:show_orders.html.twig', array(
            'orders' => $orders,
            'breadcrumb_context' => 'user_profile',
        ));
    }
}
