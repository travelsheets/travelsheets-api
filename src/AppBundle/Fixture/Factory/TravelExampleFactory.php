<?php

namespace AppBundle\Fixture\Factory;

use AppBundle\Entity\Travel;
use AppBundle\Entity\User;
use AppBundle\Fixture\OptionsResolver\DateOption;
use AppBundle\Fixture\OptionsResolver\LazyOption;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravelExampleFactory extends AbstractExampleFactory
{
    /**
     * @param OptionsResolver $resolver
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $userRepository = $this->entityManager->getRepository(User::class);

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

            ->setDefault('user', LazyOption::randomOne($userRepository))
            ->setNormalizer('user', LazyOption::findOneBy($userRepository, 'email'))
        ;
    }

    /**
     * @param array $options
     *
     * @return object
     */
    public function create(array $options = [])
    {
        $options = $this->optionsResolver->resolve($options);

        $travel = new Travel();

        $travel->setName($options['name']);
        $travel->setSummary($options['summary']);
        $travel->setDateStart($options['date_start']);
        $travel->setDateEnd($options['date_end']);
        $travel->setUser($options['user']);

        return $travel;
    }
}
