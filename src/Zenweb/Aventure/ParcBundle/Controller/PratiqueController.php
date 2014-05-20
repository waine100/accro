<?php

namespace Zenweb\Aventure\ParcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PratiqueController extends Controller
{
    public function faqAction()
    {
        return $this->render('ZenwebAventureParcBundle:Pratique:faq.html.twig');
    }
}
