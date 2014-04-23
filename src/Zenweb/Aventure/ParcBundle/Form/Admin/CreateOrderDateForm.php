<?php
namespace Zenweb\Aventure\ParcBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;

class CreateOrderDateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /**
         * genemu_jquerydate
         */
        $orderForm = $builder->create('order', 'form', array('data_class' => get_class(new SalesFlatOrder())));
        $orderForm->add('bookingDate', 'date', array(
            'widget' => 'single_text',
            //'read_only' => true,
            'required' => true,
        ));
        $builder->add($orderForm);
    }

    public function getName() {
        return 'createOrderDate';
    }


}