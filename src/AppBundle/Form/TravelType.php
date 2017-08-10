<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 08/08/2017
 * Time: 23:59
 */

namespace AppBundle\Form;


use AppBundle\Entity\Travel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravelType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
            'label' => 'form.name',
        ));
        $builder->add('summary', TextareaType::class, array(
            'label' => 'form.summary',
            'required' => false,
        ));
        $builder->add('dateStart', DateType::class, array(
            'label' => 'form.date_start',
            'placeholder' => array(
                'year' => 'form.date.year', 'month' => 'form.date.month', 'day' => 'form.date.day'
            ),
            'model_timezone' => 'Europe/Paris',
        ));
        $builder->add('dateEnd', DateType::class, array(
            'label' => 'form.date_end',
            'placeholder' => array(
                'year' => 'form.date.year', 'month' => 'form.date.month', 'day' => 'form.date.day'
            ),
            'required' => false,
        ));
        $builder->add('save', SubmitType::class, array('label' => 'actions.save'));
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Travel::class,
        ));
    }

}