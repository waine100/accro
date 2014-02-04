<?php

namespace Zenweb\Aventure\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ZenwebAventureUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
