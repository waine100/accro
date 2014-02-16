<?php
namespace Zenweb\Aventure\ParcBundle\Form\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateOrderDateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /**
         * genemu_jquerydate
         */
        $builder->add('bookingDate', 'date', array(
            'widget' => 'single_text',
            //'read_only' => true,
            'required' => true,
        ));
    }

    public function getName() {
        return 'createOrderDate';
    }


}