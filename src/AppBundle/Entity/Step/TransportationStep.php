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
     * @var string
     *
     * @ORM\Column(name="opening_luggage", type="datetime", nullable=true)
     */
    private $openingLuggage;

    /**
     * @var string
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
     * @return string
     */
    public function getOpeningLuggage()
    {
        return $this->openingLuggage;
    }

    /**
     * @param string $openingLuggage
     * @return TransportationStep
     */
    public function setOpeningLuggage($openingLuggage)
    {
        $this->openingLuggage = $openingLuggage;
        return $this;
    }

    /**
     * @return string
     */
    public function getClosingLuggage()
    {
        return $this->closingLuggage;
    }

    /**
     * @param string $closingLuggage
     * @return TransportationStep
     */
    public function setClosingLuggage($closingLuggage)
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