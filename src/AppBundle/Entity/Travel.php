<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContext;

/**
 * Travel
 *
 * @ORM\Table(name="travel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TravelRepository")
 */
class Travel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text", nullable=true)
     */
    private $summary;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_start", type="datetime")
     *
     * @Assert\NotBlank()
     *
     * @Assert\Expression(
     *     "this.getDateStart() <= this.getDateEnd()",
     *     message="Start date must be lower or equal than end date"
     * )
     */
    private $dateStart;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="date_end", type="datetime", nullable=true)
     *
     * @Assert\Expression(
     *     "this.getDateStart() <= this.getDateEnd()",
     *     message="End date must be greater or equal than start date"
     * )
     */
    private $dateEnd;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set summary
     *
     * @param string $summary
     *
     * @return $this
     */
    public function setSummary($summary = null)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @return DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * @param DateTime $dateStart
     *
     * @return $this
     */
    public function setDateStart(DateTime $dateStart)
    {
        $this->dateStart = $dateStart;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param DateTime $dateEnd
     *
     * @return $this
     */
    public function setDateEnd(DateTime $dateEnd = null)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }
}

