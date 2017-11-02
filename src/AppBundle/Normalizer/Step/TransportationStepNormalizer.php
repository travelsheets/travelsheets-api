<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 02/11/2017
 * Time: 16:57
 */

namespace AppBundle\Normalizer\Step;

use AppBundle\Entity\Step\TransportationStep;
use AppBundle\Normalizer\AbstractStepNormalizer;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class TransportationStepNormalizer extends AbstractStepNormalizer
{
    /**
     * Normalizes an object into a set of arrays/scalars.
     *
     * @param TransportationStep $object object to normalize
     * @param string $format format the normalization result will be encoded as
     * @param array $context Context options for the normalizer
     *
     * @return array
     *
     * @throws InvalidArgumentException   Occurs when the object given is not an attempted type for the normalizer
     * @throws CircularReferenceException Occurs when the normalizer detects a circular reference when no circular
     *                                    reference handler can fix it
     * @throws LogicException             Occurs when the normalizer is not called in an expected context
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return array_merge(parent::normalize($object, $format, $context), array(
            '@type' => 'TransportationStep',
            'from' => $object->getFrom(),
            'to' => $object->getTo(),
            'company' => $object->getCompany(),
            'bookingNumber' => $object->getBookingNumber(),
            'flightNumber' => $object->getFlightNumber(),
            'openingLuggage' => $this->normalizer->normalize($object->getOpeningLuggage(), $format, array(DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i:s')),
            'closingLuggage' => $this->normalizer->normalize($object->getClosingLuggage(), $format, array(DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i:s')),
            'seat' => $object->getSeat(),
            'type' => $object->getType(),
        ));
    }

    /**
     * Checks whether the given class is supported for normalization by this normalizer.
     *
     * @param mixed $data Data to normalize
     * @param string $format The format being (de-)serialized from or into
     *
     * @return bool
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof TransportationStep;
    }
}