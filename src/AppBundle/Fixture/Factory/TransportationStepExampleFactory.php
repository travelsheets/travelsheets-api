<?php

namespace AppBundle\Fixture\Factory;

use AppBundle\Entity\Step\TransportationStep;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransportationStepExampleFactory extends AbstractStepExampleFactory
{
    /**
     * @inheritDoc
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver
//            ->setDefault('from', function (Options $options) {
//                return null;
//            })

//            ->setDefault('to', function (Options $options) {
//                return null;
//            })

            ->setDefault('company', function (Options $options) {
                return $this->faker->company;
            })

            ->setDefault('booking_number', function (Options $options) {
                return $this->faker->regexify('[A-Z0-9]{8,12}');
            })

            ->setDefault('flight_number', function (Options $options) {
                return $this->faker->regexify('[A-Z0-9]{8,12}');
            })

            ->setDefault('opening_luggage', function (Options $options) {
                return $this->faker->dateTimeBetween($options['date_start'], $options['date_start']);
            })

            ->setDefault('closing_luggage', function (Options $options) {
                return $this->faker->dateTimeBetween($options['opening_luggage'], $options['date_start']);
            })

            ->setDefault('seat', function (Options $options) {
                return $this->faker->regexify('[A-F][0-9]{1,3}');
            })

            ->setDefault('type', function (Options $options) {
                return $this->faker->randomElement(TransportationStep::getTypes());
            })
        ;
    }

    /**
     * @inheritDoc
     */
    public function create(array $options = [])
    {
        $options = $this->optionsResolver->resolve($options);

        $transportationStep = new TransportationStep();

        $transportationStep->setTravel($options['travel']);

        $transportationStep->setName($options['name']);
        $transportationStep->setSummary($options['summary']);
        $transportationStep->setDateStart($options['date_start']);
        $transportationStep->setDateEnd($options['date_end']);
        $transportationStep->setPrice($options['price']);
        $transportationStep->setCurrency($options['currency']);

//        $transportationStep->setFrom($options['from']);
//        $transportationStep->setTo($options['to']);
        $transportationStep->setCompany($options['company']);
        $transportationStep->setBookingNumber($options['booking_number']);
        $transportationStep->setFlightNumber($options['flight_number']);
        $transportationStep->setOpeningLuggage($options['opening_luggage']);
        $transportationStep->setClosingLuggage($options['closing_luggage']);
        $transportationStep->setSeat($options['seat']);
        $transportationStep->setType($options['type']);

        return $transportationStep;
    }

}