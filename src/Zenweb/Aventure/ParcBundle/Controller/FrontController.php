<?php

namespace Zenweb\Aventure\ParcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller
{
    public function homeAction()
    {
        return $this->render('ZenwebAventureParcBundle:Front:home.html.twig');
    }
}
