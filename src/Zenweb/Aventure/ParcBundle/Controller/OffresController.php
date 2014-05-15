<?php

namespace Zenweb\Aventure\ParcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OffresController extends Controller
{
    public function gpAction()
    {
        return $this->render('ZenwebAventureParcBundle:Offres:gp.html.twig');
    }

    public function groupeAction()
    {
        return $this->render('ZenwebAventureParcBundle:Offres:groupe.html.twig');
    }

    public function scolaireAction()
    {
        return $this->render('ZenwebAventureParcBundle:Offres:scolaire.html.twig');
    }

    public function seminaireAction()
    {
        return $this->render('ZenwebAventureParcBundle:Offres:seminaire.html.twig');
    }

}
