<?php

namespace AppBundle\Fixture\Factory;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractExampleFactory implements ExampleFactoryInterface
{
    /**
     * @param OptionsResolver $resolver
     */
    abstract protected function configureOptions(OptionsResolver $resolver);
}
