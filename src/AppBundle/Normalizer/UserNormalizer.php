<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 11/12/2017
 * Time: 18:34
 */

namespace AppBundle\Normalizer;


use AppBundle\Entity\User;
use CoreBundle\Normalizer\BaseNormalizer;

class UserNormalizer extends BaseNormalizer
{
    /**
     * @inheritDoc
     *
     * @param User $object
     */
    public function normalize($object, $format = null, array $context = array())
    {
        return array(
            'firstname' => $object->getFirstname(),
            'lastname' => $object->getLastname(),
            'email' => $object->getEmail(),
        );
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof User;
    }

}