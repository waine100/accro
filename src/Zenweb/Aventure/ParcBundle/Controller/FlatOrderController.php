<?php

namespace Zenweb\Aventure\ParcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FlatOrderController extends Controller
{
    public function statusAction($status)
    {
        return $this->render('ZenwebAventureParcBundle:FlatOrder:listStatus.html.twig', array(
            'status'       => $status
        ));
    }
}
