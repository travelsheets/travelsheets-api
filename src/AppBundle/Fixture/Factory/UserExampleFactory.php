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
use AppBundle\Entity\User;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * @author Loïc Frémont <loic@mobizel.com>
 */
class UserExampleFactory extends AbstractExampleFactory
{
    /**
     * @param OptionsResolver $resolver
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefault('first_name', function (Options $options) {
                return ucfirst($this->faker->firstName);
            })

            ->setDefault('last_name', function (Options $options) {
                return ucfirst($this->faker->lastName);
            })

            ->setDefault('email', function (Options $options) {
                return $this->faker->email;
            })

            ->setDefault('password', function (Options $options) {
                return $this->faker->password;
            })

            ->setDefault('verified', function (Options $options) {
                return true;
            })

            ->setDefault('token', function(Options $options) {
                return null;
            })
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

        $user = new User();

        // Display email and password to console
        echo $options['email'] . " : " . $options['password'] . "\r\n";

        $user->setFirstname($options['first_name']);
        $user->setLastname($options['last_name']);
        $user->setEmail($options['email']);
        $user->setPlainPassword($options['password']);
        $user->setVerified($options['verified']);
        $user->setToken($options['token']);

        return $user;
    }
}
