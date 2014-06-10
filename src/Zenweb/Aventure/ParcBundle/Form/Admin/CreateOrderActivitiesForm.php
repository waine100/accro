<?php
namespace Zenweb\Aventure\ParcBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Zenweb\Aventure\ParcBundle\Form\SalesFlatItemType;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;

class CreateOrderActivitiesForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $orderForm = $builder->create('order', 'form', array('data_class' => get_class(new SalesFlatOrder())));
        $orderForm->add('items', 'collection', array('label' => 'Liste des activités', 'type' => 'zenweb_aventure_parcbundle_salesflatitem', 'allow_add' => true, 'allow_delete' => true, 'options' => array('form_data'=>$options['data'])));
        $builder->add($orderForm);
    }

    public function getName()
    {
        return 'createOrderActivity';
    }

}