<?php

/**
 * Rewrite the profile form in fo.
 */

namespace Zenweb\Aventure\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use Sonata\UserBundle\Form\Type\ProfileType as BaseType;

class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->remove('gender')
                ->remove('dateOfBirth')
                ->remove('dateOfBirth')
                ->remove('website')
                ->remove('biography')
                ->remove('locale')
                ->remove('timezone');
        $builder->add('mobile', null, array('label' => 'Portable'))
                ->add('address', null, array('label' => 'Adresse'))
                ->add('city', null, array('label' => 'Ville'))
                ->add('zip', null, array('label' => 'Code postal'))
                ->add('newsletter', null, array('label' => 'Newsletter', 'required' => false))
        ;

    }

    public function getName()
    {
        return 'zenweb_user_profile';
    }
}
