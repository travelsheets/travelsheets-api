<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 02/11/2017
 * Time: 12:42
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Travel;
use AppBundle\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TravelFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $users = $manager->getRepository(User::class)->findAll();

        foreach($users as &$user) {

            // Current travel
            $travel = new Travel();
            $travel->setName("Current Travel");
            $travel->setSummary($user->getFirstname() . '\'s current travel');
            $travel->setDateStart((new DateTime())->modify('-2 days'));
            $travel->setDateEnd((new DateTime())->modify('+2 days'));

            $travel->setUser($user);

            $manager->persist($travel);

            // Create future travels
            for($i=1; $i<5; $i++) {
                $travel = new Travel();
                $travel->setName("Future Travel $i");
                $travel->setSummary($user->getFirstname() . '\'s future travel');
                $travel->setDateStart((new DateTime())->modify('+'.($i * 10).' days'));
                $travel->setDateEnd((new DateTime())->modify('+'.($i * 10 + 5).' days'));

                $travel->setUser($user);

                $manager->persist($travel);
            }

            // Create past travels
            for($i=1; $i<=5; $i++) {
                $travel = new Travel();
                $travel->setName("Past Travel $i");
                $travel->setSummary($user->getFirstname() . '\'s past travel');
                $travel->setDateStart((new DateTime())->modify('-'.($i * 10 + 5).' days'));
                $travel->setDateEnd((new DateTime())->modify('-'.($i * 10).' days'));

                $travel->setUser($user);

                $manager->persist($travel);
            }
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return array_merge(parent::getDependencies(), array(
            UserFixtures::class,
        ));
    }
}