<?php
namespace Zenweb\Aventure\ParcBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class SalesFlatOrderAdmin extends Admin
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
            ->addIdentifier('id')
            ->addIdentifier('reference')
            ->addIdentifier('user');
        $listMapper
            ->add('status', 'string', array('template' => 'ZenwebAventureParcBundle:OrderAdmin:list_status.html.twig'))
            ->add('baseTotal')
            ->add('baseTotalPaid')
            ;

    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filterMapper)
    {
        $filterMapper
            ->add('id')
            ->add('status');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
            ->add('id')
            ->add('createdAt')
            ->end();
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('id')
            ->add('createdAt')
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    public function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
    }
}