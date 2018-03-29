<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 12/12/2017
 * Time: 16:42
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 3; $i++) {
            $user = new User();
            $user->setFirstname('Lorem ' . $i);
            $user->setLastname('Ipsum ' . $i);
            $user->setEmail('user' . $i . '@example.com');
            $user->setPlainPassword('user' . $i);
            $user->setVerified(true);

            $manager->persist($user);
        }

        $manager->flush();
    }
}