<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 11/12/2017
 * Time: 17:23
 */

namespace AppBundle\Form;


use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegisterType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname', TextType::class, array(
            'constraints' => array(
                new NotBlank(),
            ),
        ));

        $builder->add('lastname', TextType::class, array(
            'constraints' => array(
                new NotBlank(),
            ),
        ));

        $builder->add('email', TextType::class, array(
            'constraints' => array(
                new NotBlank(),
                new Email(),
            ),
        ));

        $builder->add('password', TextType::class, array(
            'property_path' => 'plainPassword',
            'constraints' => array(
                new NotBlank(),
                new Regex(array(
                    'pattern' => '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,30}$/',
                    'message' => 'Le mot de passe doit contenir entre 8 et 30 caractères et être composé d\'au moins une minuscule, une majuscule et un chiffre',
                )),
            ),
        ));
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
            'csrf_protection' => false,
        ));
    }

}