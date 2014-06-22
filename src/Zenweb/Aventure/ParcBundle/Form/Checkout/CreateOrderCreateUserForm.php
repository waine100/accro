<?php
namespace Zenweb\Aventure\ParcBundle\Form\Checkout;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;
use Zenweb\Aventure\ParcBundle\Entity\User;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreateOrderCreateUserForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $orderForm = $builder->create('order', 'form', array('data_class' => get_class(new SalesFlatOrder()), 'cascade_validation' => true));
        $userForm  = $builder->create('user', 'form', array('data_class' => get_class(new User()), 'cascade_validation' => true));
        $userForm->add('gender', 'sonata_user_gender', array(
            'required'           => true,
            'translation_domain' => 'SonataUserBundle',
            'label'              => 'Civilité',
            'error_bubbling' => true
        ))
            ->add('lastname', null, array('label' => 'Nom', 'error_bubbling' => true))
            ->add('firstname', null, array('label' => 'Prénom', 'error_bubbling' => true))
            ->add('email', null, array('error_bubbling' => true))

            ->add('plainPassword', 'password', array(
                'label' => 'Mot de passe', 'error_bubbling' => true
            ))
            ->add('newsletter', null, array('required' => false, 'label' => 'Inscription à la newsletter', 'error_bubbling' => true))
            ;
        $orderForm->add($userForm);
        $builder->add($orderForm);

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'cascade_validation' => true
        ));
    }

    public function getName()
    {
        return 'CreateOrderChooseUser';
    }

}