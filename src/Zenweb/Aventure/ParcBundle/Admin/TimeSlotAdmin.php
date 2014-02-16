<?php
namespace Zenweb\Aventure\ParcBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\UserBundle\Model\UserInterface;

use Zenweb\Aventure\ParcBundle\Entity\TimeSlot;

class TimeSlotAdmin extends Admin
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
            ->add('activity')
            ->add('typicalDay')
            ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('activity', null, array('label' => 'Activité'))
            ->add('typicalDay', null, array('label' => 'Journée Type'))
            ->add('beginTime', null, array('label' => 'Heure de début'))
            ->add('endTime', null, array('label' => 'Heure de fin'))
            ->add('capacity', null, array('label' => 'Capacité'))
            ->add('enabled',  null, array('editable' => true, 'label' => 'Activé'))
            ;

    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
            ->add('typicalDay', null, array('label' => 'Journée Type'))
            ->add('activity', null, array('label' => 'Activité'))
            ->add('beginTime', null, array('label' => 'Heure de début'))
            ->add('endTime', null, array('label' => 'Heure de fin'))
            ->add('capacity', null, array('label' => 'Capacité'))
            ->add('enabled', null, array('label' => 'Activé'))
            ->end();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General')
            ->add('typicalDay', null, array('label' => 'Journée Type'))
            ->add('activity', null, array('label' => 'Activité'))
            ->add('beginTime', null, array('label' => 'Heure de début'))
            ->add('endTime', null, array('label' => 'Heure de fin'))
            ->add('capacity', null, array('label' => 'Capacité'))
            ->add('enabled', 'choice', array('label' => 'Activé', 'choices' => array(0 => 'Non', 1 => 'Oui')))
            ->end();

    }
}