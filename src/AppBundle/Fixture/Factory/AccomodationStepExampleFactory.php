<?php

namespace AppBundle\Fixture\Factory;

use AppBundle\Entity\Step\AccomodationStep;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccomodationStepExampleFactory extends AbstractStepExampleFactory
{
    /**
     * @inheritDoc
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver
//            ->setDefault('place', function (Options $options) {
//                return null;
//            })
            ->setDefault('company', function (Options $options) {
                return $this->faker->company;
            })

            ->setDefault('booking_number', function (Options $options) {
                return $this->faker->regexify('[A-Z0-9]{8,12}');
            })

            ->setDefault('type', function (Options $options) {
                return $this->faker->randomElement(AccomodationStep::getTypes());
            })
        ;
    }

    /**
     * @inheritDoc
     */
    public function create(array $options = [])
    {
        $options = $this->optionsResolver->resolve($options);

        $accomodationStep = new AccomodationStep();

        $accomodationStep->setTravel($options['travel']);

        $accomodationStep->setName($options['name']);
        $accomodationStep->setSummary($options['summary']);
        $accomodationStep->setDateStart($options['date_start']);
        $accomodationStep->setDateEnd($options['date_end']);
        $accomodationStep->setPrice($options['price']);
        $accomodationStep->setCurrency($options['currency']);
//        $accomodationStep->setPlace($options['place']);
        $accomodationStep->setCompany($options['company']);
        $accomodationStep->setBookingNumber($options['booking_number']);
        $accomodationStep->setType($options['type']);

        return $accomodationStep;
    }

}