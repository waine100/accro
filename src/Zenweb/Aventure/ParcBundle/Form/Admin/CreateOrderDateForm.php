<?php
namespace Zenweb\Aventure\ParcBundle\Form\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateOrderDateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('bookingDate', 'genemu_jquerydate', array(
            'widget' => 'single_text'
        ));
    }

    public function getName() {
        return 'createOrderDate';
    }


}