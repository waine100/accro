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


class UserAdmin extends SonataUserAdmin
{

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('gender', 'sonata_user_gender', array(
                'required' => true,
                'translation_domain' => $this->getTranslationDomain()
            ))
            ->add('lastname', null, array('required' => true))
            ->add('firstname', null, array('required' => true))
            //->add('username')
            ->add('email')
            ->add('plainPassword', 'text', array(
                'required' => (!$this->getSubject() || is_null($this->getSubject()->getId()))
            ))
            ->add('phone', null, array('required' => false, 'label' => 'Téléphone portable'))
            ->add('mobile', null, array('required' => false, 'label' => 'Téléphone portable'))
            ->add('address', null, array('required' => false, 'label' => 'Adresse'))
            ->add('newsletter', null, array('required' => false, 'label' => 'Inscription à la newsletter'))
            ->add('commentary', null, array('required' => false, 'label' => 'Commentaires'))
            ->end()
            ->with('Groups')
            ->add('groups', 'sonata_type_model', array(
                'required' => false,
                'expanded' => true,
                'multiple' => true
            ))
            ->end();

        if ($this->getSubject() && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->with('Management')
                ->add('realRoles', 'sonata_security_roles', array(
                    'label' => 'form.label_roles',
                    'expanded' => true,
                    'multiple' => true,
                    'required' => false
                ))
                ->add('locked', null, array('required' => false))
                ->add('expired', null, array('required' => false))
                ->add('enabled', null, array('required' => false))
                ->add('credentialsExpired', null, array('required' => false))
                ->end();
        }
    }

    /**
     * Add user to Particulier group by default if no groups are selected
     * {@inheritdoc}
     */
    public function prePersist($user)
    {
        parent::prePersist($user);
        if (!$user->getGroups()->count()) {
            $entity = $this->getConfigurationPool()->getContainer()->get('doctrine')->getRepository('ZenwebAventureParcBundle:Group')->findOneByName('Particulier');
            $user->addGroup($entity);
        }
    }
} 