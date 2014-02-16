<?php
namespace Zenweb\Aventure\ParcBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\UserBundle\Model\UserInterface;

class ParcAdmin extends Admin
{
    /**
     * {@inheritdoc}
     */
    public function getFormBuilder()
    {
        $this->formOptions['data_class'] = $this->getClass();

        $options = $this->formOptions;

        $formBuilder = $this->getFormContractor()->getFormBuilder($this->getUniqid(), $options);

        $this->defineFormBuilder($formBuilder);

        return $formBuilder;
    }


    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description')
            ->add('address')
            ->add('mail')
            ->add('enabled', null, array('editable' => true, 'label' => 'Activé'));

    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('name')
            ->add('mail');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
            ->add('name')
            ->add('description')
            ->add('address')
            ->add('mail')
            ->end()/*->with('Security')
                ->add('token')
                ->add('twoStepVerificationCode')
            ->end()*/
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('name')
            ->add('description', null, array('attr' => array('class' => 'ckeditor')))
            ->add('address')
            ->add('mail')
            ->add('fileImage', 'file', array('label' => 'Image', 'required' => false))
            ->add('filePlan', 'file', array('label' => 'Plan', 'required' => false))
            ->add('enabled', 'choice', array('label' => 'Activé', 'choices' => array(0 => 'Non', 1 => 'Oui')))
            ->end();

        /*$formMapper
            ->with('Security')
            ->add('token', null, array('required' => false))
            ->add('twoStepVerificationCode', null, array('required' => false))
            ->end();*/
    }

    public function prePersist($parc)
    {
        $parc->preUpload();
    }

    public function preUpdate($parc)
    {
        $parc->preUpload();
    }

    public function postPersist($parc)
    {
        $parc->upload();
    }

    public function postUpdate($parc)
    {
        $parc->upload();
    }

    public function postRemove($parc)
    {
        $parc->removeUpload();
    }

}