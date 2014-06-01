<?php
namespace Zenweb\Aventure\ParcBundle\Form\Checkout;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Zenweb\Aventure\ParcBundle\Form\SalesFlatExtraType;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;

class CreateOrderPaymentForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $orderForm = $builder->create('order', 'form', array('data_class' => get_class(new SalesFlatOrder())));
        $orderForm->add('checkoutMethod', 'choice', array('expanded' => true, 'choices' => array('at_arrival' => 'A l\'arrivé', 'cb' => 'Par carte bancaire'),'required' => true, 'label' => 'Moyen de paiement'));
        $builder->add($orderForm);
    }

    public function getName()
    {
        return 'createOrderPayment';
    }

}