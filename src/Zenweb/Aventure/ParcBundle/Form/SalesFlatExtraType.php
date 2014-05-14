<?php

namespace Zenweb\Aventure\ParcBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Zenweb\Aventure\ParcBundle\Entity\ExtraRepository;
use Zenweb\Aventure\ParcBundle\Entity\TimeSlotRepository;
use Zenweb\Aventure\ParcBundle\Entity\TypicalDayRepository;
use Zenweb\Aventure\ParcBundle\Entity\SalesFlatExtra;

class SalesFlatExtraType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $formData = $options['form_data'];
        $parcId = $formData->order->getBooking()->getParc()->getId();

        $builder
            ->add('name', 'genemu_jqueryselect2_entity', array('class' => 'ZenwebAventureParcBundle:Extra', 'query_builder' => function (ExtraRepository $er) use ($parcId) {
                    return $er->createQueryBuilder('u');
                        //->where('u.parcs = :parcId')
                        //->orderBy('u.beginTime', 'ASC');
                       // ->setParameter('parcId', $parcId);
                }, 'empty_value' => 'Choisissez une option',
                 'label' => 'Options'

            ))
            ->add('qty', 'integer' ,array('label' => 'Quantité'))
            //->add('rowPriceExtra', 'integer', array('data_class' => 'Zenweb\Aventure\ParcBundle\Entity\Extra', 'property_path' => 'pricePerUnit', 'read_only' => true))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Zenweb\Aventure\ParcBundle\Entity\SalesFlatExtra',
            'form_data'  => array()
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zenweb_aventure_parcbundle_salesflatextra';
    }

}