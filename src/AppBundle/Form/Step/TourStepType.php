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
            'choices' => TourStep::getTypes(),
        ));
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => TourStep::class,
            'csrf_protection' => false,
        ));
    }
}