<?php
namespace Zenweb\Aventure\ParcBundle\Form\Checkout;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Zenweb\Aventure\ParcBundle\Form\SalesFlatExtraType;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;

class CreateOrderRecapForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $orderForm = $builder->create('order', 'form', array('data_class' => get_class(new SalesFlatOrder())));
        $orderForm->add('cgv', 'checkbox', array('required' => true, 'label' => 'Merci d\'accepter nos CGV', 'mapped' => false));
        $builder->add($orderForm);
    }

    public function getName()
    {
        return 'createOrderRecap';
    }

}