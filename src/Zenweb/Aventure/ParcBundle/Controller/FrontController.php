<?php

namespace Zenweb\Aventure\ParcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller
{
    public function homeAction()
    {
        return $this->render('ZenwebAventureParcBundle:Front:home.html.twig');
    }

    public function contactAction()
    {
        return $this->render('ZenwebAventureParcBundle:Front:contact.html.twig');
    }

    public function mentionsAction()
    {
        return $this->render('ZenwebAventureParcBundle:Front:mentions.html.twig');
    }

    public function constructionAction()
    {
        return $this->render('ZenwebAventureParcBundle:Front:construction.html.twig');
    }

    public function faqAction()
    {
        return $this->render('ZenwebAventureParcBundle:Front:faq.html.twig');
    }
}
