<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 07/11/2017
 * Time: 17:18
 */

namespace AppBundle\Form;


use AppBundle\Entity\StepAttachment;
use AppBundle\Entity\Upload;
use AppBundle\Repository\UploadRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StepAttachmentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class);
        $builder->add('summary', TextareaType::class);
        $builder->add('file', EntityType::class, array(
            'class' => Upload::class,
            'query_builder' => function (UploadRepository $repository) {
                return $repository->createQueryBuilder('entity');
            }
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => StepAttachment::class,
            'csrf_protection' => false,
        ));
    }
}