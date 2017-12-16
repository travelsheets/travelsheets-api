<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 02/11/2017
 * Time: 15:54
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Step\AccomodationStep;
use AppBundle\Entity\Step\TourStep;
use AppBundle\Entity\Step\TransportationStep;
use AppBundle\Entity\Travel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StepFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $travels = $manager->getRepository(Travel::class)->findAll();

        foreach($travels as $key => &$travel) {
            $accomodationStep = new AccomodationStep();
            $accomodationStep->setName('Accomodation ' . $key);
            $accomodationStep->setSummary('Lorem ipsum dolor sit amet  ' . $key);
            $accomodationStep->setPrice(rand(10,30));
            $accomodationStep->setCurrency('EUR');
            $accomodationStep->setTravel($travel);
            $accomodationStep->setDateStart((new \DateTime())->setDate(2017, 11, 11)->setTime(16, 00));
            $accomodationStep->setDateEnd((new \DateTime())->setDate(2017, 11, 20)->setTime(12, 00));
            $accomodationStep->setType(AccomodationStep::TYPE_LOCATION);
            $manager->persist($accomodationStep);

            $transportationStep = new TransportationStep();
            $transportationStep->setName('Transportation ' . $key);
            $transportationStep->setSummary('Lorem ipsum dolor sit amet  ' . $key);
            $transportationStep->setPrice(rand(10,30));
            $transportationStep->setCurrency('EUR');
            $transportationStep->setTravel($travel);
            $transportationStep->setDateStart((new \DateTime())->setDate(2017, 11, 11)->setTime(10, 00));
            $transportationStep->setDateEnd((new \DateTime())->setDate(2017, 11, 11)->setTime(12, 00));
            $transportationStep->setBookingNumber(rand(30000, 100000));
            $transportationStep->setCompany('AirFrance');
            $transportationStep->setFlightNumber(rand(30000, 100000));
            $transportationStep->setOpeningLuggage((new \DateTime())->setDate(2017, 11, 11)->setTime(9, 00));
            $transportationStep->setClosingLuggage((new \DateTime())->setDate(2017, 11, 11)->setTime(9, 50));
            $transportationStep->setSeat('E13');
            $transportationStep->setType(TransportationStep::TYPE_PLANE);
            $manager->persist($transportationStep);

            $tourStep = new TourStep();
            $tourStep->setName('Tour ' . $key);
            $tourStep->setSummary('Lorem ipsum dolor sit amet  ' . $key);
            $tourStep->setPrice(rand(10,30));
            $tourStep->setCurrency('EUR');
            $tourStep->setTravel($travel);
            $tourStep->setDateStart((new \DateTime())->setDate(2017, 11, 11)->setTime(10, 00));
            $tourStep->setDateEnd((new \DateTime())->setDate(2017, 11, 11)->setTime(12, 00));
            $tourStep->setType(TourStep::TYPE_PLACE);
            $manager->persist($tourStep);
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return array_merge(parent::getDependencies(), array(TravelFixtures::class));
    }
}