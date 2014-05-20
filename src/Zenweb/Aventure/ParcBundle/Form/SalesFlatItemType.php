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

//http://stackoverflow.com/questions/9052916/how-to-use-select-box-related-on-another-select-box
class SalesFlatItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $formData     = $options['form_data'];
        $typicalDayId = $formData->order->getBooking()->getTypicalDay()->getId();

        $builder
            ->add('activity')
            /*->add('timeSlot', 'genemu_jqueryselect2_entity', array('class' => 'ZenwebAventureParcBundle:TimeSlot', 'query_builder' => function (TimeSlotRepository $er) use ($typicalDayId) {
                    return $er->createQueryBuilder('u')
                        ->where('u.typicalDay = :typicalDay')
                        ->orderBy('u.beginTime', 'ASC')
                        ->setParameter('typicalDay', $typicalDayId);
                }, 'empty_value' => 'Choisissez une activité',
                 'label' => 'Activité'

            ))*/
            ->add('timeSlot')
            ->add('qty', 'integer', array('label' => 'Quantité'))
            ->add('basePrice', 'genemu_jqueryselect2_entity', array('class' => 'ZenwebAventureParcBundle:Price'));

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
                'label'           => 'register.region.label',
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
        $refreshPrices = function ($form, $activity) use ($factory, $typicalDayId) {
            $form->add($factory->createNamed('basePrice', 'entity', null, array(
                'class'           => 'Zenweb\Aventure\ParcBundle\Entity\Price',
                'property'        => 'name',
                'label'           => 'prices',
                'auto_initialize' => false,
                'query_builder'   => function (PriceRepository $repository) use ($activity, $typicalDayId) {
                        $qb2 = $repository->createQueryBuilder('Prices');
                        $qb2->select($qb2->expr()->max('tpmax.qty'))
                            ->from('ZenwebAventureParcBundle:TierPrice', 'tpmax')
                            ->where('tpmax.qty<=:qty')
                            ->setParameter("qty", 15);
                        $qb2->getQuery()->getSQL();

                        $qb = $repository->createQueryBuilder("p");
                        return $qb->select('p', 'tp')
                            ->join('p.groups', 'g')
                            ->join("ZenwebAventureParcBundle:TimeSlot", "ts", "WITH", "ts.activity = p.activity")
                            ->leftJoin('p.TierPrices', 'tp', 'WITH', $qb->expr()->andX($qb->expr()->lte('tp.qty', ':qty'), $qb->expr()->eq('tp.qty', "($qb2)")))
                            ->where($qb->expr()->in('g.id', 1))
                            ->andWhere("ts.id=:idTs")
                            ->setParameter("idTs", 1)
                            ->setParameter("qty", 15);

                    }
            )));
        };


        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($refreshTimeSlot, $refreshPrices) {
            $form = $event->getForm();
            $data = $event->getData();
            //var_dump($data[0]);
            if ($data == null) {
                $refreshTimeSlot($form, null);
                //$refreshPrices($form, null);
            }

            if ($data instanceof SalesFlatItem) {
                $refreshTimeSlot($form, $data->getActivity());
            }
        });

        $builder->addEventListener(FormEvents::PRE_BIND, function (FormEvent $event) use ($refreshTimeSlot, $refreshPrices) {
            $form = $event->getForm();
            $data = $event->getData();

            if (array_key_exists('timeSlot', $data)) {
                $refreshTimeSlot($form, $data['timeSlot']);
            }
            if (array_key_exists('basePrice', $data)) {
                //$refreshPrices($form, $data['basePrice']);
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