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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
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
            'label' => 'entities.step.transportation.info.type',
            'choices' => array(
                'entities.step.transportation.types.plane' => 'plane',
                'entities.step.transportation.types.boat' => 'boat',
                'entities.step.transportation.types.car' => 'car',
                'entities.step.transportation.types.train' => 'train',
                'entities.step.transportation.types.taxi' => 'taxi',
                'entities.step.transportation.types.bike' => 'bike',
                'entities.step.transportation.types.subway' => 'subway',
                'entities.step.transportation.types.other' => 'other',
            ),
            'placeholder' => 'entities.step.transportation.info.type'
        ));

        $builder->add('company', TextType::class, array(
            'label' => 'entities.step.transportation.info.company',
            'required' => false,
        ));

        $builder->add('bookingNumber', TextType::class, array(
            'label' => 'entities.step.transportation.info.bookingNumber',
            'required' => false,
        ));

        $builder->add('flightNumber', TextType::class, array(
            'label' => 'entities.step.transportation.info.flightNumber',
            'required' => false,
        ));

        $builder->add('openingLuggage', TimeType::class, array(
            'label' => 'entities.step.transportation.info.openingLuggage',
            'required' => false,
            'placeholder' => array(
                'hour' => 'form.date.hour', 'minute' => 'form.date.minute',
            ),
        ));

        $builder->add('closingLuggage', TimeType::class, array(
            'label' => 'entities.step.transportation.info.closingLuggage',
            'required' => false,
            'placeholder' => array(
                'hour' => 'form.date.hour', 'minute' => 'form.date.minute',
            ),
        ));

        $builder->add('seat', TextType::class, array(
            'label' => 'entities.step.transportation.info.seat',
            'required' => false,
        ));
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => TransportationStep::class,
        ));
    }
}