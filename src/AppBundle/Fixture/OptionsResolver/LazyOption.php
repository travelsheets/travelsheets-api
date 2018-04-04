<?php

namespace AppBundle\Fixture\OptionsResolver;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\Options;
use Webmozart\Assert\Assert;

/**
 * Using the hacky hack to distinct between option which wasn't set
 * and option which was set to empty.
 *
 * Usage:
 *
 *   $optionsResolver
 *     ->setDefault('option', LazyOption::randomOne($repository))
 *     ->setNormalizer('option', LazyOption::findOneBy($repository, 'code'))
 *   ;
 *
 *   Returns:
 *     - null if user explicitly set it (['option' => null])
 *     - random one if user skipped that option ([])
 *     - specific one if user defined that option (['option' => 'CODE'])
 */
final class LazyOption
{
    /**
     * @param EntityRepository $repository
     *
     * @return \Closure
     */
    public static function randomOne(EntityRepository $repository)
    {
        return function (Options $options) use ($repository) {
            $objects = $repository->findAll();

            if ($objects instanceof Collection) {
                $objects = $objects->toArray();
            }

            Assert::notEmpty($objects);

            return $objects[array_rand($objects)];
        };
    }

    /**
     * @param EntityRepository $repository
     * @param int $chanceOfRandomOne
     *
     * @return \Closure
     */
    public static function randomOneOrNull(EntityRepository $repository, $chanceOfRandomOne)
    {
        return function (Options $options) use ($repository, $chanceOfRandomOne) {
            if (mt_rand(1, 100) > $chanceOfRandomOne) {
                return null;
            }

            $objects = $repository->findAll();

            if ($objects instanceof Collection) {
                $objects = $objects->toArray();
            }

            return 0 === count($objects) ? null : $objects[array_rand($objects)];
        };
    }

    /**
     * @param EntityRepository $repository
     * @param int $amount
     *
     * @return \Closure
     */
    public static function randomOnes(EntityRepository $repository, $amount)
    {
        return function (Options $options) use ($repository, $amount) {
            $objects = $repository->findAll();

            if ($objects instanceof Collection) {
                $objects = $objects->toArray();
            }

            $selectedObjects = [];
            for (; $amount > 0 && count($objects) > 0; --$amount) {
                $randomKey = array_rand($objects);

                $selectedObjects[] = $objects[$randomKey];

                unset($objects[$randomKey]);
            }

            return $selectedObjects;
        };
    }

    /**
     * @param EntityRepository $repository
     *
     * @return \Closure
     */
    public static function all(EntityRepository $repository)
    {
        return function (Options $options) use ($repository) {
            return $repository->findAll();
        };
    }

    /**
     * @param EntityRepository $repository
     * @param string $field
     *
     * @return \Closure
     */
    public static function findBy(EntityRepository $repository, $field)
    {
        return function (Options $options, $previousValues) use ($repository, $field) {
            if (null === $previousValues || [] === $previousValues) {
                return $previousValues;
            }

            Assert::isArray($previousValues);

            $resources = [];
            foreach ($previousValues as $previousValue) {
                if (is_object($previousValue)) {
                    $resources[] = $previousValue;
                } else {
                    $resources[] = $repository->findOneBy([$field => $previousValue]);
                }
            }

            return $resources;
        };
    }

    /**
     * @param EntityRepository $repository
     * @param string $field
     *
     * @return \Closure
     */
    public static function findOneBy(EntityRepository $repository, $field)
    {
        return function (Options $options, $previousValue) use ($repository, $field) {
            if (null === $previousValue || [] === $previousValue) {
                return $previousValue;
            }

            if (is_object($previousValue)) {
                return $previousValue;
            } else {
                return $repository->findOneBy([$field => $previousValue]);
            }
        };
    }
}
