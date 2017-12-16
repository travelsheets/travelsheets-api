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
use DateTime;
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

    const TYPE_HOTEL = "hotel";
    const TYPE_LOCATION = "location";
    const TYPE_CAMPING = "camping";
    const TYPE_HOSTEL = "hostel";
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
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    public static function getTypes()
    {
        return array(
            self::TYPE_HOTEL,
            self::TYPE_LOCATION,
            self::TYPE_CAMPING,
            self::TYPE_HOSTEL,
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
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     * @return AccomodationStep
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
     * @return AccomodationStep
     */
    public function setBookingNumber($bookingNumber)
    {
        $this->bookingNumber = $bookingNumber;
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