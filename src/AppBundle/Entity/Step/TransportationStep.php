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

use DateTime;
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
    const TYPE_PLANE = "plane";
    const TYPE_BOAT = "boat";
    const TYPE_CAR = "car";
    const TYPE_TRAIN = "train";
    const TYPE_TAXI = "taxi";
    const TYPE_BIKE = "bike";
    const TYPE_SUBWAY = "subway";
    const TYPE_OTHER = "other";

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
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255, nullable=true)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="booking_number", type="string", length=255, nullable=true)
     */
    private $bookingNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="flight_number", type="string", length=255, nullable=true)
     */
    private $flightNumber;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="opening_luggage", type="datetime", nullable=true)
     */
    private $openingLuggage;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="closing_luggage", type="datetime", nullable=true)
     */
    private $closingLuggage;

    /**
     * @var string
     *
     * @ORM\Column(name="seat", type="string", nullable=true)
     */
    private $seat;

    /**
     * @return array
     */
    public static function getTypes()
    {
        return array(
            self::TYPE_PLANE,
            self::TYPE_BOAT,
            self::TYPE_CAR,
            self::TYPE_TRAIN,
            self::TYPE_TAXI,
            self::TYPE_BIKE,
            self::TYPE_SUBWAY,
            self::TYPE_OTHER,
        );
    }

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
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return TransportationStep
     */
    public function setCompany($company)
    {
        $this->company = $company;
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
     * @return TransportationStep
     */
    public function setBookingNumber($bookingNumber)
    {
        $this->bookingNumber = $bookingNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getFlightNumber()
    {
        return $this->flightNumber;
    }

    /**
     * @param string $flightNumber
     * @return TransportationStep
     */
    public function setFlightNumber($flightNumber)
    {
        $this->flightNumber = $flightNumber;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getOpeningLuggage()
    {
        return $this->openingLuggage;
    }

    /**
     * @param DateTime $openingLuggage
     * @return TransportationStep
     */
    public function setOpeningLuggage(DateTime $openingLuggage)
    {
        $this->openingLuggage = $openingLuggage;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getClosingLuggage()
    {
        return $this->closingLuggage;
    }

    /**
     * @param DateTime $closingLuggage
     * @return TransportationStep
     */
    public function setClosingLuggage(DateTime $closingLuggage)
    {
        $this->closingLuggage = $closingLuggage;
        return $this;
    }

    /**
     * @return string
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /**
     * @param string $seat
     * @return TransportationStep
     */
    public function setSeat($seat)
    {
        $this->seat = $seat;
        return $this;
    }

    /**
     * @return string
     */
    public function getDType()
    {
        return 'transportation';
    }
}