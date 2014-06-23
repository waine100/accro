<?php
namespace Zenweb\Aventure\ParcBundle\Form\Checkout;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreateOrderDateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        /**
         * genemu_jquerydate
         */
        $orderForm = $builder->create('order', 'form', array('data_class' => get_class(new SalesFlatOrder()), 'cascade_validation' => true));
        $orderForm->add('bookingDate', 'date', array(
            'widget' => 'single_text',
            //'read_only' => true,
            'required' => true,
            'error_bubbling' => true
        ));
        $builder->add($orderForm);
    }

    public function getName() {
        return 'createOrderDate';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'cascade_validation' => true
        ));
    }


}