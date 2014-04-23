<?php

namespace Zenweb\Aventure\ParcBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Zenweb\Aventure\ParcBundle\Entity\TimeSlotRepository;
use Zenweb\Aventure\ParcBundle\Entity\TypicalDayRepository;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;

class SalesFlatItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $formData = $options['form_data'];
        $typicalDayId = $formData->order->getBooking()->getTypicalDay()->getId();

        $builder
            ->add('timeSlot', 'genemu_jqueryselect2_entity', array('class' => 'ZenwebAventureParcBundle:TimeSlot', 'query_builder' => function (TimeSlotRepository $er) use ($typicalDayId) {
                    return $er->createQueryBuilder('u')
                        ->where('u.typicalDay = :typicalDay')
                        ->orderBy('u.beginTime', 'ASC')
                        ->setParameter('typicalDay', $typicalDayId);
                }, 'empty_value' => 'Choisissez une activité',
                 'label' => 'Activité'

            ))
            ->add('qty', 'integer' ,array('label' => 'Quantité'))
            ->add('basePrice', 'genemu_jqueryselect2_entity', array('class' => 'ZenwebAventureParcBundle:Price'))
        ;
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