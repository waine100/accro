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

    public function contactAction(Request $request)
    {
        $contact = $this->createFormBuilder();

        $type = array('Un particulier' => 'Un particulier',
            'Une association' => 'Une association',
            'Une entreprise' => 'Une entreprise',
            'Un établissement scolaire' => 'Un établissement scolaire',
            'Un centre de loisirs' => 'Un centre de loisirs',
            'Un CE' => 'Un CE',
            'Autres' => 'Autres',
        );

        $parcs = array('Paris Est Davy Crockett à Marne la Vallée (77)' => 'Paris Est Davy Crockett à Marne la Vallée (77)',
            'Paris Sud Aventure à St Fargeau Ponthierry (77)' => 'Paris Sud Aventure à St Fargeau Ponthierry (77)',
            'Paris Ouest Aventure' => 'Paris Ouest Aventure',
        );

        $contact->add('type', 'choice', array('label' => '', 'attr' => array('class' => 'form-control'), 'label_attr' => array('class' => 'col-md-2 control-label'), 'choices' => $type))
            ->add('demande', 'choice', array('label' => '', 'attr' => array('class' => 'form-control'), 'label_attr' => array('class' => 'col-md-2 control-label'), 'choices' => $parcs))
            ->add('nom', 'text', array('label' => '', 'attr' => array('class' => 'form-control'), 'label_attr' => array('class' => 'col-md-2 control-label')))
            ->add('prenom', 'text', array('label' => '', 'attr' => array('class' => 'form-control'), 'label_attr' => array('class' => 'col-md-2 control-label')))
            ->add('email', 'email', array('label' => '', 'attr' => array('class' => 'form-control'), 'label_attr' => array('class' => 'col-md-2 control-label')))
            ->add('telephone', 'text', array('required' => false, 'label' => '', 'attr' => array('class' => 'form-control'), 'label_attr' => array('class' => 'col-md-2 control-label')))
            ->add('message', 'textarea', array('label' => '', 'attr' => array('class' => 'form-control'), 'label_attr' => array('class' => 'col-md-2 control-label')))
            ->add('save', 'submit', array('label' => '', 'attr' => array('class' => 'btn btn-default')));
        $form = $contact->getForm();

        $parcs = $this->getDoctrine()->getManager()->getRepository('ZenwebAventureParcBundle:Parc')->findByEnabled(true);

        $form->handleRequest($request);

        $retour = '';
        if ($form->isValid()) {
            $data = $form->getData();
            try{
                $message = \Swift_Message::newInstance()
                    ->setSubject('Hello Email')
                    ->setFrom('contact@aventure-aventure.com')
                    ->setTo('flavien.chantelot@gmail.com')
                    ->setBody($this->renderView('ZenwebAventureParcBundle:Mail:contact.html.twig', array('data' => $data)))
                ;
                $this->get('mailer')->send($message);
                $retour = 'success';
            }
            catch(Exception $e) {
                $retour = 'fail';
            }
        }

        return $this->render('ZenwebAventureParcBundle:Front:contact.html.twig', array('parcs' => $parcs, 'form' => $form->createView(), 'retour' => $retour));
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

    public function showParcAction($id)
    {
        $parc = $this->getDoctrine()->getManager()->getRepository('ZenwebAventureParcBundle:Parc')->find($id);
        return $this->render('ZenwebAventureParcBundle:Front:show_parc.html.twig', array('parc' => $parc));
    }

    public function menuTopAction($active)
    {
        $parcs = $this->getDoctrine()->getManager()->getRepository('ZenwebAventureParcBundle:Parc')->findByEnabled(true);
        return $this->render('ZenwebAventureParcBundle:Front:menu_top.html.twig', array('parcs' => $parcs, 'active' => $active));
    }
}
