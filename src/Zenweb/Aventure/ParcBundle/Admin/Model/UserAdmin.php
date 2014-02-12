<?php
/**
 * Created by PhpStorm.
 * User: Rogal
 * Date: 12/02/14
 * Time: 22:00
 */

namespace Zenweb\Aventure\ParcBundle\Admin\Model;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\UserBundle\Admin\Model\UserAdmin as SonataUserAdmin;


class UserAdmin extends SonataUserAdmin {

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('lastname', null, array('required' => true))
            ->add('firstname', null, array('required' => true))
            //->add('username')
            ->add('email')
            ->add('plainPassword', 'text', array(
                'required' => (!$this->getSubject() || is_null($this->getSubject()->getId()))
            ))
            ->end()
            ->with('Groups')
            ->add('groups', 'sonata_type_model', array(
                'required' => false,
                'expanded' => true,
                'multiple' => true
            ))
            ->end()
            ->with('Profile')
            ->add('dateOfBirth', 'birthday', array('required' => false))
            ->add('website', 'url', array('required' => false))
            ->add('biography', 'text', array('required' => false))
            ->add('gender', 'sonata_user_gender', array(
                'required' => true,
                'translation_domain' => $this->getTranslationDomain()
            ))
            ->add('locale', 'locale', array('required' => false))
            ->add('timezone', 'timezone', array('required' => false))
            ->add('phone', null, array('required' => false))
            ->end()
            ->with('Social')
            ->add('facebookUid', null, array('required' => false))
            ->add('facebookName', null, array('required' => false))
            ->add('twitterUid', null, array('required' => false))
            ->add('twitterName', null, array('required' => false))
            ->add('gplusUid', null, array('required' => false))
            ->add('gplusName', null, array('required' => false))
            ->end()
        ;

        if ($this->getSubject() && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Management')
                ->add('realRoles', 'sonata_security_roles', array(
                    'label'    => 'form.label_roles',
                    'expanded' => true,
                    'multiple' => true,
                    'required' => false
                ))
                ->add('locked', null, array('required' => false))
                ->add('expired', null, array('required' => false))
                ->add('enabled', null, array('required' => false))
                ->add('credentialsExpired', null, array('required' => false))
                ->end()
            ;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($user)
    {
        parent::preUpdate($user);
    }
} 