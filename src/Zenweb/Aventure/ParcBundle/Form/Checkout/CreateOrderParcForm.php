<?php
namespace Zenweb\Aventure\ParcBundle\Form\Checkout;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;

class CreateOrderParcForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $orderForm = $builder->create('order', 'form', array('data_class' => get_class(new SalesFlatOrder())));
        $orderForm->add('parc', 'entity',
            array('class'      => 'ZenwebAventureParcBundle:Parc',
                  'label'      => "Veuillez sélectionner le parc"
            ));
        $builder->add($orderForm);
    }

    public function getName()
    {
        return 'createOrderParc';
    }

}