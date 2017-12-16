<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 09/08/2017
 * Time: 12:10
 */

namespace AppBundle\Entity\Step;


use AppBundle\Entity\AbstractStep;
use AppBundle\Entity\Place;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class TourStep
 * @package AppBundle\Entity\Step
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StepRepository")
 * @ORM\Table(name="tour_step")
 *
 */
class TourStep extends AbstractStep
{
    const TYPE_MUSEUM = "museum";
    const TYPE_PLACE = "place";
    const TYPE_RESTAURANT = "restaurant";
    const TYPE_COFFEE = "coffee";
    const TYPE_CLUB = "club";
    const TYPE_OTHER = "other";

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
     * @var string
     *
     * @ORM\Column(name="booking_number", type="string", length=255, nullable=true)
     */
    private $bookingNumber;

    /**
     * @return string
     */
    public function getDType()
    {
        return 'tour';
    }

    /**
     * @return array
     */
    public static function getTypes()
    {
        return array(
            self::TYPE_MUSEUM,
            self::TYPE_PLACE,
            self::TYPE_RESTAURANT,
            self::TYPE_COFFEE,
            self::TYPE_CLUB,
            self::TYPE_OTHER,
        );
    }

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
    public function getBookingNumber()
    {
        return $this->bookingNumber;
    }

    /**
     * @param string $bookingNumber
     * @return $this
     */
    public function setBookingNumber($bookingNumber)
    {
        $this->bookingNumber = $bookingNumber;
        return $this;
    }
}