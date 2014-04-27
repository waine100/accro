<?php
namespace Zenweb\Aventure\ParcBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\UserBundle\Model\UserInterface;

use Zenweb\Aventure\ParcBundle\Entity\TypicalDay;

class ExtraAdmin extends Admin
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

    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('name')
            ->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description')
            ->add('enabled');

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
            ->add('parcs')
            ->add('typicalDays')
            ->add('pricePerUnit')
            ->add('qtyMin')
            ->add('enabled')
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('name', 'text', array('required' => true, 'help' => $this->trans('help.coupon.name')))
            ->add('description', 'textarea', array('required' => true, 'attr' => array('class' => 'ckeditor')))
            ->add('parcs', null, array('label' => 'Parcs', 'multiple' => true))
            ->add('typicalDays', null, array('label' => 'Journée Type', 'multiple' => true))
            ->add('pricePerUnit', null, array('required' => true))
            ->add('qtyMin', null, array('required' => true))
            ->add('enabled', 'choice', array('required' => true, 'label' => 'Activé', 'choices' => array(0 => 'Non', 1 => 'Oui')))
            ->end();

    }
}