<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 02/11/2017
 * Time: 16:50
 */

namespace AppBundle\Normalizer;


use AppBundle\Entity\AbstractStep;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

abstract class AbstractStepNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * Normalizes an object into a set of arrays/scalars.
     *
     * @param AbstractStep $object object to normalize
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
            '@id' => $object->getId(),
            '@type' => 'AbstractStep',
            'name' => $object->getName(),
            'summary' => $object->getSummary(),
            'dateStart' => $this->normalizer->normalize($object->getDateStart(), $format, array(DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i:s')),
            'dateEnd' => $this->normalizer->normalize($object->getDateEnd(), $format, array(DateTimeNormalizer::FORMAT_KEY => 'Y-m-d H:i:s')),
            'price' => $object->getPrice(),
            'currency' => $object->getCurrency(),
        );
    }
}