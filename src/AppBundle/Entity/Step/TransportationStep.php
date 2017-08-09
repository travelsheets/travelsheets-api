<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 09/08/2017
 * Time: 01:00
 */

namespace AppBundle\Entity\Step;


use AppBundle\Entity\Place;
use AppBundle\Entity\AbstractStep;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class TransportationStep
 * @package AppBundle\Entity\Step
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StepRepository")
 * @ORM\Table(name="transportation_step")
 */
class TransportationStep extends AbstractStep
{
    /**
     * @var Place
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Place")
     * @ORM\JoinColumn(nullable=true)
     */
    private $from;

    /**
     * @var Place
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Place")
     * @ORM\JoinColumn(nullable=true)
     */
    private $to;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @return Place
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param Place $from
     *
     * @return $this
     */
    public function setFrom(Place $from = null)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return Place
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param Place $to
     *
     * @return $this
     */
    public function setTo(Place $to = null)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getDType()
    {
        return 'transportation';
    }
}