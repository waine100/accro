<?php
namespace Zenweb\Aventure\ParcBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateOrderParcForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $validValues = array(2, 4);
        $builder->add('parc', 'choice', array(
            'choices' => array_combine($validValues, $validValues),
            'empty_value' => '',
        ));
    }

    public function getName()
    {
        return 'createOrderParc';
    }

}