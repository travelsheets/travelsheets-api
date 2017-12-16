<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 06/11/2017
 * Time: 15:37
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Upload;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class UploadFixture extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $rootDir = __DIR__ . '/../../../../web/attachments';
        exec("rm -r $rootDir");

        $sampleRealPath = __DIR__ . '/resources/sample.pdf';
        $tempRealPath = __DIR__ . '/resources/sample_temp.pdf';

            // Create file
        copy($sampleRealPath, $tempRealPath);
        $file = new File($tempRealPath);

        $upload = new Upload();
        $upload->setUploadedFile($file);

        $manager->persist($upload);
        $manager->flush();
    }
}