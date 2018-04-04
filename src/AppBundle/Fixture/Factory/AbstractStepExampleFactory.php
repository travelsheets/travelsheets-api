<?php

namespace AppBundle\Fixture\Factory;

use AppBundle\Entity\Travel;
use AppBundle\Fixture\OptionsResolver\DateOption;
use AppBundle\Fixture\OptionsResolver\LazyOption;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractStepExampleFactory extends AbstractExampleFactory
{
    /**
     * @inheritDoc
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $travelRepository = $this->entityManager->getRepository(Travel::class);

        $resolver
            ->setDefault('name', function (Options $options) {
                return ucfirst($this->faker->country);
            })

            ->setDefault('summary', function(Options $options) {
                return $this->faker->sentence(15, true);
            })

            ->setDefault('date_start', function (Options $options) {
                return $this->faker->dateTimeInInterval('-1 month', '+1 month');
            })
            ->setNormalizer('date_start', DateOption::fromString())

            ->setDefault('date_end', function(Options $options) {
                return $this->faker->dateTimeBetween($options['date_start'], '+1 month');
            })
            ->setNormalizer('date_end', DateOption::fromString())

            ->setDefault('price', function(Options $options) {
                return $this->faker->randomFloat(2, 0, 1000);
            })

            ->setDefault('currency', function(Options $options) {
                return $this->faker->currencyCode;
            })

            ->setDefault('travel', LazyOption::randomOne($travelRepository))
            ->setNormalizer('travel', LazyOption::findOneBy($travelRepository, 'name'))
        ;
    }
}