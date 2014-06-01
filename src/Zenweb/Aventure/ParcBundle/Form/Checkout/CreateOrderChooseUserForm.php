<?php
namespace Zenweb\Aventure\ParcBundle\Form\Checkout;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;

class CreateOrderChooseUserForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $orderForm = $builder->create('order', 'form', array('data_class' => get_class(new SalesFlatOrder())));
        $orderForm->add('user', 'genemu_jqueryselect2_entity', array('class'=>'ZenwebAventureParcBundle:User', 'label' => 'Choisissez l\'utilisateur'));
        $builder->add($orderForm);
    }

    public function getName()
    {
        return 'CreateOrderChooseUser';
    }

}