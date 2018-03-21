<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Step
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StepRepository")
 * @ORM\Table(name="step")
 * @ORM\InheritanceType("JOINED")
 */
abstract class AbstractStep
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
     */
    private $name;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="dateStart", type="datetime")
     */
    private $dateStart;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="dateEnd", type="datetime", nullable=true)
     */
    private $dateEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text", nullable=true)
     */
    private $summary;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=255, nullable=true)
     */
    private $currency;

    /**
     * @var Travel
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Travel", inversedBy="steps")
     */
    private $travel;

    /**
     * @var StepAttachment[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\StepAttachment", mappedBy="step")
     */
    private $attachments;

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
     * Set dateStart
     *
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
     * Get dateStart
     *
     * @return DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param DateTime $dateEnd
     *
     * @return $this
     */
    public function setDateEnd(DateTime $dateEnd = null)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set summary
     *
     * @param string $summary
     *
     * @return $this
     */
    public function setSummary($summary)
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
     * Set price
     *
     * @param float $price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return Travel
     */
    public function getTravel()
    {
        return $this->travel;
    }

    /**
     * @param Travel $travel
     */
    public function setTravel(Travel $travel)
    {
        $this->travel = $travel;
    }

    /**
     * @return string
     */
    public abstract function getDType();

    /**
     * @return StepAttachment[]
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @param StepAttachment[] $attachments
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;
    }
}
