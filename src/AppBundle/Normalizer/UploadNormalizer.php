<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 06/11/2017
 * Time: 17:53
 */

namespace AppBundle\Normalizer;

use AppBundle\Entity\Upload;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UploadNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * Normalizes an object into a set of arrays/scalars.
     *
     * @param Upload $object object to normalize
     * @param string $format format the normalization result will be encoded as
     * @param array $context Context options for the normalizer
     *
     * @return array
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return array(
            '@type' => 'Upload',
            '@id' => $object->getId(),
            'filename' => $object->getFilename(),
            'path' => $object->getPath(),
            'mimeType' => $object->getMimeType(),
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
        return $data instanceof Upload;
    }
}