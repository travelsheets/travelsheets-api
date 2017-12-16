<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 10/08/2017
 * Time: 14:52
 */

namespace AppBundle\Repository;

use AppBundle\Entity\AbstractStep;
use Doctrine\ORM\EntityRepository;

class StepAttachmentRepository extends EntityRepository
{
    public function findAllByStepQueryBuilder(AbstractStep $step)
    {
        return $this->createQueryBuilder('entity')
            ->where('entity.step = :step')
            ->setParameter(':step', $step)
        ;
    }
}