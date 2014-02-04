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
            ->add('id')
            ->add('name')
            ->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('description');

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
            ->add('visibility')
            ->add('status')
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
            ->add('description', 'textarea', array('required' => true))
            ->add('parcs', null, array('expanded' => true, 'by_reference' => false, 'multiple' => true))
            ->add('typicalDays', null, array('expanded' => true, 'by_reference' => false, 'multiple' => true))
            ->add('pricePerUnit', null, array('required' => true))
            ->add('qtyMin', null, array('required' => true))
            ->add('visibility', 'choice', array('required' => true, 'choices' => array(0 => 'Non', 1 => 'Oui')))
            ->add('status', 'choice', array('required' => true, 'choices' => array(0 => $this->trans('choice.disable'), 1 => $this->trans('choice.enable'))))
            ->end();

    }
}