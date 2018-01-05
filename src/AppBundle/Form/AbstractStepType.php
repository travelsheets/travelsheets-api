<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 09/08/2017
 * Time: 12:14
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

abstract class AbstractStepType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class);

        $builder->add('summary', TextareaType::class);

        $builder->add('dateStart', DateTimeType::class, array(
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd HH:mm:ss',
            'model_timezone' => 'Europe/Paris',
        ));

        $builder->add('dateEnd', DateTimeType::class, array(
            'widget' => 'single_text',
            'format' => 'yyyy-MM-dd HH:mm:ss',
            'model_timezone' => 'Europe/Paris',
        ));

        $builder->add('price', NumberType::class);

        $builder->add('currency', ChoiceType::class, array(
            'choices' => array(
                'EUR',
            ),
        ));

        $this->addCustomFields($builder, $options);

        $builder->add('save', SubmitType::class, array('label' => 'Enregistrer'));
    }

    public abstract function addCustomFields(FormBuilderInterface $builder, array $options);
}