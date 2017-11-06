<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StepAttachment
 *
 * @ORM\Table(name="step_attachment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StepAttachmentRepository")
 */
class StepAttachment
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
     * @var string
     *
     * @ORM\Column(name="summary", type="text", nullable=true)
     */
    private $summary;

    /**
     * @var AbstractStep
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AbstractStep")
     */
    private $step;

    /**
     * @var Upload
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Upload")
     */
    private $file;

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
     * @return AbstractStep
     */
    public function getStep()
    {
        return $this->step;
    }

    /**
     * @param AbstractStep $step
     *
     * @return $this
     */
    public function setStep(AbstractStep $step)
    {
        $this->step = $step;
        return $this;
    }

    /**
     * @return Upload
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param Upload $file
     *
     * @return $this
     */
    public function setFile(Upload $file)
    {
        $this->file = $file;
        return $this;
    }
}
