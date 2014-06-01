<?php
namespace Zenweb\Aventure\ParcBundle\Form\Checkout;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateOrderUserForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('addUser', 'choice', array('label' => 'Nouveau client ?', 'choices' => array(0 => 'Non', 1 => 'Oui')));
    }

    public function getName()
    {
        return 'CreateOrderUser';
    }

}