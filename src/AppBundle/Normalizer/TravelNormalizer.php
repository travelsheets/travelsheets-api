<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 01/11/2017
 * Time: 20:05
 */

namespace AppBundle\Normalizer;

use AppBundle\Entity\Travel;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TravelNormalizer implements NormalizerInterface
{

    /**
     * Normalizes an object into a set of arrays/scalars.
     *
     * @param Travel $object object to normalize
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
        return array(
            'id' => $object->getId(),
            'name' => $object->getName(),
            'summary' => $object->getSummary(),
            'date_start' => $object->getDateStart()->format('Y-m-d'),
            'date_end' => $object->getDateEnd()->format('Y-m-d'),
        );
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
        return $data instanceof Travel;
    }
}