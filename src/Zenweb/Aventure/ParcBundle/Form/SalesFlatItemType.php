<?php

namespace Zenweb\Aventure\ParcBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Zenweb\Aventure\ParcBundle\Entity\TimeSlotRepository;
use Zenweb\Aventure\ParcBundle\Entity\TypicalDayRepository;

class SalesFlatItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $formData = $options['form_data'];
        $typicalDayId = $formData->getBooking()->getTypicalDay()->getId();

        $builder
            //->add('createdAt', 'date')
            //->add('updatedAt', 'date')
            ->add('name', 'entity', array('class' => 'ZenwebAventureParcBundle:TimeSlot', 'query_builder' => function (TimeSlotRepository $er) use ($typicalDayId) {
                    return $er->createQueryBuilder('u')
                        ->where('u.typicalDay = :typicalDay')
                        ->orderBy('u.beginTime', 'ASC')
                        ->setParameter('typicalDay', $typicalDayId);
                },
            ))
            //->add('description', 'textarea')
            ->add('qty', 'integer')
            ->add('basePrice', 'entity', array('class' => 'ZenwebAventureParcBundle:Price'))
            //->add('rowTotal', 'money')//->add('order', 'int');
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