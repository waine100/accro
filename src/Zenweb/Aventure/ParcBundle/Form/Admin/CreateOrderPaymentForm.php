<?php
namespace Zenweb\Aventure\ParcBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Zenweb\Aventure\ParcBundle\Form\SalesFlatExtraType;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;

class CreateOrderPaymentForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $orderForm = $builder->create('order', 'form', array('data_class' => get_class(new SalesFlatOrder())));
        $orderForm->add('cgv', 'checkbox', array('required' => true, 'label' => 'Merci de valider les CGV', 'mapped' => false);
        $builder->add($orderForm);
    }

    public function getName()
    {
        return 'createOrderPayment';
    }

}