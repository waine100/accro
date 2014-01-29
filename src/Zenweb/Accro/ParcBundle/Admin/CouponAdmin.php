<?php
namespace Zenweb\Accro\ParcBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\UserBundle\Model\UserInterface;

use Zenweb\Accro\ParcBundle\Entity\Coupon;

class CouponAdmin extends Admin
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
            ->add('code')
            ->add('fromDate')
            ->add('toDate')
            ->add('isActive');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('code')
            ->add('fromDate')
            ->add('toDate')
            ->add('isActive');

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
            ->add('code')
            ->add('fromDate')
            ->add('toDate')
            ->add('isActive')
            ->end()
            ->with('Actions')
            ->add('simpleAction')
            ->add('discountAmount')
            ->end()
            ->with('Restrictions')
            ->add('usesPerCustomer')
            ->add('usesPerCoupon')
            ->add('stopRulesProcessing')
            ->add('sortOrder')
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
            ->add('code', 'text', array('required' => true))
            ->add('fromDate', 'date', array('required' => true, 'format' => 'dMMMyyyy'))
            ->add('toDate', 'date', array('required' => true, 'format' => 'dMMMyyyy'))
            ->add('isActive', 'choice', array('required' => true, 'choices' => array(0 => $this->trans('choice.disable'), 1 => $this->trans('choice.enable'))))
            ->add('parc', 'sonata_type_model_list', array(
                'btn_add'       => 'button.add', //Specify a custom label
                'btn_list'      => 'button.list', //which will be translated
                'btn_delete'    => false, //or hide the button.
                'btn_catalogue' => 'ZenwebAccroParcBundle' //Custom translation domain for buttons
            ), array(
                'placeholder' => 'No parc selected'
            ))
            ->end()
            ->with('Actions')
            ->add('simpleAction', 'choice', array('required' => true, 'choices' => array(Coupon::BY_FIXED_ACTION => $this->trans('choice.by_fixed'), Coupon::BY_PERCENT_ACTION => $this->trans('choice.by_percent'))))
            ->add('discountAmount', null, array('required' => true))
            ->end()
            ->with('Restrictions')
            ->add('usesPerCustomer', null, array('required' => true))
            ->add('usesPerCoupon', null, array('required' => true))
            ->add('stopRulesProcessing', 'choice', array('required' => true, 'choices' => array(0 => 'Non', 1 => 'Oui')))
            ->add('sortOrder', null, array('required' => true))
            ->end();

    }

    /*public function validate(ErrorElement $errorElement, $object)
    {
        throw new \Exception(__METHOD__);
    }*/
}