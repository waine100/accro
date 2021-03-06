<?php
namespace Zenweb\Aventure\ParcBundle\Form\Admin;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;
use Zenweb\Aventure\ParcBundle\Entity\User;

class CreateOrderCreateUserForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $orderForm = $builder->create('order', 'form', array('data_class' => get_class(new SalesFlatOrder())));
        $userForm  = $builder->create('user', 'form', array('data_class' => get_class(new User())));
        $userForm->add('gender', 'choice', array('required' => true,'label' => 'Civilité', 'choices' => array(0 => 'Monsieur', 1 => 'Madame')))
            ->add('lastname', null, array('required' => true, 'label' => 'Nom'))
            ->add('firstname', null, array('required' => true, 'label' => 'Prénom'))
            ->add('email')

            ->add('plainPassword', 'password', array(
                'required' => true, 'label' => 'Mot de passe'
            ))
            ->add('newsletter', null, array('required' => false, 'label' => 'Inscription à la newsletter'))
            ;
        $orderForm->add($userForm);
        $builder->add($orderForm);

    }

    public function getName()
    {
        return 'CreateOrderChooseUser';
    }

}