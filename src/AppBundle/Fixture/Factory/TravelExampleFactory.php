<?php

/**
 * This file is part of Jedisjeux
 *
 * (c) Loïc Frémont
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Fixture\Factory;
use AppBundle\Entity\Travel;
use AppBundle\Entity\User;
use AppBundle\Fixture\OptionsResolver\LazyOption;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * @author Loïc Frémont <loic@mobizel.com>
 */
class TravelExampleFactory extends AbstractExampleFactory
{
    /**
     * @param OptionsResolver $resolver
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $userRepository = $this->entityManager->getRepository(User::class);

        $resolver
            ->setDefault('name', function (Options $options) {
                return ucfirst($this->faker->words(3, true));
            })

            ->setDefault('user', LazyOption::randomOne($userRepository))
            ->setNormalizer('user', LazyOption::findOneBy($userRepository, 'email'))
        ;
    }

    /**
     * @param array $options
     *
     * @return object
     */
    public function create(array $options = [])
    {
        $options = $this->optionsResolver->resolve($options);

        $travel = new Travel();

        $travel->setName($options['name']);
        $travel->setUser($options['user']);
        $travel->setDateStart(new \DateTime());

        return $travel;
    }
}
