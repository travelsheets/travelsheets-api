<?php

namespace AppBundle\Fixture\Factory;

use Doctrine\ORM\EntityManager;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractExampleFactory implements ExampleFactoryInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var FakerGenerator
     */
    protected $faker;

    /**
     * @var OptionsResolver
     */
    protected $optionsResolver;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->faker = FakerFactory::create('fr_FR');
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    /**
     * @param OptionsResolver $resolver
     */
    abstract protected function configureOptions(OptionsResolver $resolver);
}
