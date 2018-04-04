<?php

namespace AppBundle\Fixture\Factory;

use AppBundle\Entity\Step\TourStep;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TourStepExampleFactory extends AbstractStepExampleFactory
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

            ->setDefault('booking_number', function (Options $options) {
                return $this->faker->regexify('[A-Z0-9]{8,12}');
            })

            ->setDefault('type', function (Options $options) {
                return $this->faker->randomElement(TourStep::getTypes());
            })
        ;
    }

    /**
     * @inheritDoc
     */
    public function create(array $options = [])
    {
        $options = $this->optionsResolver->resolve($options);

        $tourStep = new TourStep();

        $tourStep->setTravel($options['travel']);

        $tourStep->setName($options['name']);
        $tourStep->setSummary($options['summary']);
        $tourStep->setDateStart($options['date_start']);
        $tourStep->setDateEnd($options['date_end']);
        $tourStep->setPrice($options['price']);
        $tourStep->setCurrency($options['currency']);

//        $tourStep->setPlace($options['place']);
        $tourStep->setBookingNumber($options['booking_number']);
        $tourStep->setType($options['type']);

        return $tourStep;
    }

}