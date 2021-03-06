<?php
namespace Zenweb\Aventure\ParcBundle\Form\Checkout;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreateOrderActivitiesForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $orderForm = $builder->create('order', 'form', array('data_class' => get_class(new SalesFlatOrder()), 'cascade_validation' => true));
        $orderForm->add('items', 'collection', array('label' => false, 'type' => 'zenweb_aventure_parcbundle_salesflatitem', 'cascade_validation' => true,'error_bubbling' => true, 'allow_add' => true, 'allow_delete' => true, 'options' => array('form_data'=>$options['data'])));
        $builder->add($orderForm);
    }

    public function getName()
    {
        return 'createOrderActivity';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'cascade_validation' => true
        ));
    }

}