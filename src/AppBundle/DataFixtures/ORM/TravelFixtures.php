<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 02/11/2017
 * Time: 12:42
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Travel;
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
        for($i=1; $i<=30; $i++) {
            $travel = new Travel();
            $travel->setName('Travel ' . $i);
            $travel->setSummary('Lorem ipsum dolor sit amet ' . $i);
            $travel->setDateStart((new DateTime())->setDate(2017, 11, $i));
            $travel->setDateEnd((new DateTime())->setDate(2017, 11, $i + 5));
            $manager->persist($travel);
        }

        $manager->flush();
    }
}