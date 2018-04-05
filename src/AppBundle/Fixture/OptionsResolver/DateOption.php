<?php

namespace AppBundle\Fixture\OptionsResolver;

use Symfony\Component\OptionsResolver\Options;

final class DateOption
{
    /**
     * @return \Closure
     */
    public static function fromString()
    {
        return function (Options $options, $date) {
            if (!is_string($date)) {
                return $date;
            }
            return new \DateTime($date);
        };
    }
}
