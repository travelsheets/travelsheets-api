<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 06/11/2017
 * Time: 18:23
 */

namespace AppBundle\Normalizer;


use AppBundle\Entity\StepAttachment;
use CoreBundle\Normalizer\BaseNormalizer;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\scalar;

class StepAttachmentNormalizer extends BaseNormalizer
{

    /**
     * Normalizes an object into a set of arrays/scalars.
     *
     * @param StepAttachment $object object to normalize
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
            '@type' => 'StepAttachment',
            '@id' => $object->getId(),
            'name' => $object->getName(),
            'summary' => $object->getSummary(),
            'file' => $this->normalizer->normalize($object->getFile()),
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
        return $data instanceof StepAttachment;
    }
}