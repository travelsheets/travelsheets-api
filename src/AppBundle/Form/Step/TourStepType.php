<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 09/08/2017
 * Time: 13:33
 */

namespace AppBundle\Form\Step;


use AppBundle\Entity\Step\AccomodationStep;
use AppBundle\Entity\Step\TourStep;
use AppBundle\Form\AbstractStepType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TourStepType extends AbstractStepType
{

    public function addCustomFields(FormBuilderInterface $builder, array $options)
    {
//        $builder->add('place', )
        $builder->add('type', ChoiceType::class, array(
            'label' => 'entities.step.tour.info.type',
            'choices' => array(
                'entities.step.tour.types.museum' => 'museum',
                'entities.step.tour.types.place' => 'place',
                'entities.step.tour.types.restaurant' => 'restaurant',
                'entities.step.tour.types.coffee' => 'coffee',
                'entities.step.tour.types.club' => 'club',
                'entities.step.tour.types.other' => 'other',
            ),
            'placeholder' => 'entities.step.tour.info.type',
        ));
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => TourStep::class,
        ));
    }
}