<?php
namespace Zenweb\Aventure\ParcBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateOrderUserForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) {
        /*$builder->add('user', 'sonata_type_model_list', array(
            'btn_add'       => 'button.add', //Specify a custom label
            'btn_list'      => 'button.list', //which will be translated
            'btn_delete'    => false, //or hide the button.
            'btn_catalogue' => 'ZenwebAventureParcBundle' //Custom translation domain for buttons
        ), array(
            'placeholder' => 'No user selected'
        ));*/
        $builder->add('user', 'genemu_jqueryselect2_entity', array('class'=>'ZenwebAventureParcBundle:User'));
    }

    public function getName()
    {
        return 'createOrderParc';
    }

}