<?php
namespace Zenweb\Aventure\ParcBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Zenweb\Aventure\ParcBundle\Form\SalesFlatItemType;

class CreateOrderActivitiesForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('items', 'collection', array('type' => new SalesFlatItemType(), 'allow_add' => true, 'allow_delete' => true, 'options' => array('form_data'=>$options['data'])));
    }

    public function getName()
    {
        return 'createOrderActivity';
    }

}