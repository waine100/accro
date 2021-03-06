<?php
namespace Zenweb\Aventure\ParcBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Zenweb\Aventure\ParcBundle\Form\Admin\TierPriceType;

class PriceAdmin extends Admin
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
            ->add('activity')
            ->add('groups')
            ->add('enabled', null, array('editable' => true, 'label' => 'Activé'));

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
            ->add('activity')
            ->add('price')
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('name')
            ->add('description', null, array('attr' => array('class' => 'ckeditor')))
            ->add('activity', null, array('label' => 'Activité'))
            ->add('price', null, array('label' => 'Prix'))
            ->add('enabled', 'choice', array('label' => 'Activé', 'choices' => array(0 => 'Non', 1 => 'Oui')))
            ->add('groups', null, array('label' => 'Groupes de client'))
            ->add('TierPrices', 'sonata_type_collection', array(
                                    'by_reference' => false,
                                    'cascade_validation' => true
                                ),
                                array(
                                    'edit' => 'inline',
                                    'inline' => 'table'
                                ) )
            ->end();

    }
}