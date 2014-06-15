<?php

namespace Zenweb\Aventure\ParcBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatItem;
use Zenweb\Aventure\ParcBundle\Entity\TimeSlotRepository;
use Zenweb\Aventure\ParcBundle\Entity\PriceRepository;
use Zenweb\Aventure\ParcBundle\Entity\TypicalDayRepository;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;

///import form events namespace
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvents;
use Zenweb\Aventure\ParcBundle\Form\ChoiceList\TiersPricesChoiceList;

//http://stackoverflow.com/questions/9052916/how-to-use-select-box-related-on-another-select-box
class SalesFlatItemType extends AbstractType
{
    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $formData     = $options['form_data'];
        $typicalDayId = $formData->order->getBooking()->getTypicalDay()->getId();
        $userId       = $formData->order->getUser()->getId();

        $builder
            ->add('activity')
            ->add('timeSlot', 'entity', array('class' => 'ZenwebAventureParcBundle:TimeSlot', 'empty_value' => 'Choisissez une activité',
                                                                   'label' => 'Activité'

            ))
            ->add('qty', 'integer', array('label' => 'Quantité'))
            ->add('basePrice', 'entity', array('class' => 'ZenwebAventureParcBundle:Price'));
        ;

        $factory = $builder->getFormFactory();

        /**
         * Set the only values needed into the listbox
         *
         * @param $form
         * @param $activity
         */
        $refreshTimeSlot = function ($form, $activity) use ($factory, $typicalDayId) {
            $form->add($factory->createNamed('timeSlot', 'entity', null, array(
                'class'           => 'Zenweb\Aventure\ParcBundle\Entity\TimeSlot',
                'property'        => 'name',
                'label'           => 'timeslot',
                'auto_initialize' => false,
                'query_builder'   => function (TimeSlotRepository $repository) use ($activity, $typicalDayId) {
                        $qb = $repository->createQueryBuilder('timeSlot');
                        $qb = $qb->where('timeSlot.activity = :activity_id')->setParameter('activity_id', $activity);
                        return $qb;
                    }
            )));
        };

        /**
         * Set the only values needed into the listbox
         *
         * @param $form
         * @param $activity
         */
        $refreshPrices = function ($form, $userId, $data) use ($factory) {
            if (is_array($data)) {
                $ts  = !empty($data) ? $data['timeSlot'] : null;
                $qty = !empty($data) ? $data['qty'] : null;
            } else {
                $ts  = !empty($data) ? $data->getTimeSlot()->getId() : null;
                $qty = !empty($data) ? $data->getQty() : null;
            }

            $form->add($factory->createNamed('basePrice', 'choice', null, array(
                'label'           => 'prices',
                'auto_initialize' => false,
                'choice_list'     => new TiersPricesChoiceList($this->em, $userId, $ts, $qty)
            )));
        };


        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($refreshTimeSlot, $refreshPrices, $userId) {
            $form = $event->getForm();
            $data = $event->getData();

            if ($data == null) {
                $refreshTimeSlot($form, null);
                $refreshPrices($form, null, null);
            }

            if ($data instanceof SalesFlatItem) {
                $refreshTimeSlot($form, $data->getActivity());
                $refreshPrices($form, $userId, $data);
            }
        });

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) use ($refreshTimeSlot, $refreshPrices, $userId) {
            $form = $event->getForm();
            $data = $event->getData();

            if (array_key_exists('timeSlot', $data)) {
                $refreshTimeSlot($form, $data['activity']);
            }
            if (array_key_exists('basePrice', $data)) {
                $refreshPrices($form, $userId, $data);
            }
        });
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zenweb\Aventure\ParcBundle\Entity\SalesFlatItem',
            'form_data'  => array()
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zenweb_aventure_parcbundle_salesflatitem';
    }

}