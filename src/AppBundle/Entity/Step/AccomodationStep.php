<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 09/08/2017
 * Time: 11:59
 */

namespace AppBundle\Entity\Step;


use AppBundle\Entity\AbstractStep;
use AppBundle\Entity\Place;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AccomodationStep
 * @package AppBundle\Entity\Step
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StepRepository")
 * @ORM\Table(name="accomodation_step")
 *
 */
class AccomodationStep extends AbstractStep
{
    /**
     * @var Place
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Place", inversedBy="id")
     * @ORM\JoinColumn(nullable=true)
     */
    private $place;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @return Place
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param Place $place
     * @return $this
     */
    public function setPlace(Place $place = null)
    {
        $this->place = $place;
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
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }


    /**
     * @return string
     */
    public function getDType()
    {
        return 'accomodation';
    }
}