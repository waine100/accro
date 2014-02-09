<?php
namespace Zenweb\Aventure\ParcBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateOrderParcForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('parc', 'entity', array('class'=>'ZenwebAventureParcBundle:Parc'));
    }

    public function getName()
    {
        return 'createOrderParc';
    }

}