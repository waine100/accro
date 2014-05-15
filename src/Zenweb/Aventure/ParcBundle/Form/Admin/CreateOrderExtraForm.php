<?php
namespace Zenweb\Aventure\ParcBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Zenweb\Aventure\ParcBundle\Form\SalesFlatExtraType;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;

class CreateOrderExtraForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $orderForm = $builder->create('order', 'form', array('data_class' => get_class(new SalesFlatOrder())));
        $orderForm->add('extras', 'collection', array('label' => 'Liste des options', 'type' => new SalesFlatExtraType(), 'allow_add' => true, 'allow_delete' => true, 'options' => array('form_data'=>$options['data'])));
        $builder->add($orderForm);
    }

    public function getName()
    {
        return 'createOrderExtra';
    }

}