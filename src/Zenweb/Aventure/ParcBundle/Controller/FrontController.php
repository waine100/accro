<?php

namespace Zenweb\Aventure\ParcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends Controller
{
    public function homeAction()
    {
        return $this->render('ZenwebAventureParcBundle:Front:home.html.twig');
    }

    public function showParcAction($id)
    {
        $parc = $this->getDoctrine()->getManager()->getRepository('ZenwebAventureParcBundle:Parc')->find($id);
        return $this->render('ZenwebAventureParcBundle:Front:show_parc.html.twig', array('parc' => $parc));
    }

    public function menuTopAction($active)
    {
        $parcs = $this->getDoctrine()->getManager()->getRepository('ZenwebAventureParcBundle:Parc')->findByEnabled(true);
        return $this->render('ZenwebAventureParcBundle:Front:menu_top.html.twig', array('parcs' => $parcs, 'active' => $active, 'toto' => 'tata'));
    }
}
