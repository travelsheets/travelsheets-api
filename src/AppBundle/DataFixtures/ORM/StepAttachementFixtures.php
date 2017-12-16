<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 06/11/2017
 * Time: 18:27
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\AbstractStep;
use AppBundle\Entity\StepAttachment;
use AppBundle\Entity\Upload;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class StepAttachementFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $steps = $manager->getRepository(AbstractStep::class)->findAll();

        $files = $manager->getRepository(Upload::class)->findAll();

        foreach($steps as &$step) {
            foreach($files as $i => &$file) {
                $attachment = new StepAttachment();
                $attachment->setName('File ' . ($i + 1));
                $attachment->setSummary('Lorem ipsum');
                $attachment->setFile($file);
                $attachment->setStep($step);

                $manager->persist($attachment);
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
            StepFixtures::class,
        ));
    }


}