<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 09/08/2017
 * Time: 12:20
 */

namespace AppBundle\Form\Step;


use AppBundle\Entity\Step\TransportationStep;
use AppBundle\Form\AbstractStepType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransportationStepType extends AbstractStepType
{
    public function addCustomFields(FormBuilderInterface $builder, array $options)
    {
//        $builder->add('from', EntityType::class, array(
//            'class'
//            'label' => 'Lieu de départ',
//        ));
//
//        $builder->add('to', EntityType::class, array(
//            'label' => 'Lieu d\'arrivée',
//        ));

        $builder->add('type', ChoiceType::class, array(
            'choices' => TransportationStep::getTypes(),
        ));

        $builder->add('company', TextType::class);

        $builder->add('bookingNumber', TextType::class);

        $builder->add('flightNumber', TextType::class);

        $builder->add('openingLuggage', DateTimeType::class, array(
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd HH:ii:ss',
            'model_timezone' => 'Europe/Paris',
        ));

        $builder->add('closingLuggage', DateTimeType::class, array(
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd HH:ii:ss',
            'model_timezone' => 'Europe/Paris',
        ));

        $builder->add('seat', TextType::class);
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => TransportationStep::class,
            'csrf_protection' => false,
        ));
    }
}