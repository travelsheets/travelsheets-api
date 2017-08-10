<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Intl\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Attachment
 *
 * @ORM\Table(name="attachment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AttachmentRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Attachment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255, unique=true)
     */
    protected $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    protected $path;

    /**
     * @var string
     *
     * @ORM\Column(name="mimeType", type="string", length=255)
     */
    protected $mimeType;

    /**
     * @var UploadedFile
     *
     * @Assert\NotBlank(groups={"Upload"})
     */
    protected $uploadedFile;

    /**
     * @var File
     */
    protected $file;

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
     * Set filename
     *
     * @param string $filename
     *
     * @return Attachment
     */
    public function setFilename($filename)
    {
        if (!is_string($filename)) {
            throw new UnexpectedTypeException($filename, 'string');
        }

        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Get full filename (path + filename)
     *
     * @return string
     */
    public function getFullFilename()
    {
        return $this->path . $this->filename;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Attachment
     */
    public function setPath($path)
    {
        if (!is_string($path)) {
            throw new UnexpectedTypeException($path, 'string');
        }

        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set mimeType
     *
     * @param string $mimeType
     *
     * @return Attachment
     */
    public function setMimeType($mimeType)
    {
        if (!is_string($mimeType)) {
            throw new UnexpectedTypeException($mimeType, 'string');
        }

        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get mimeType
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set file
     *
     * @param File $file
     *
     * @return Attachment
     */
    public function setFile(File $file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return File
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param File|UploadedFile $uploadedFile
     */
    public function setUploadedFile(File $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
        $this->file = null;
    }

    /**
     * @return UploadedFile
     */
    public function getUploadedFile()
    {
        return $this->uploadedFile;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->uploadFile();
    }

    /**
     * @ORM\PostRemove()
     */
    public function postRemove()
    {
        $file = $this->getUploadRootDir() . $this->getFilename();
        if (file_exists($file)) {
            unlink($file);
        }
    }

    /**
     * @ORM\PostLoad()
     */
    public function postLoad()
    {
        $this->file = new File($this->getUploadRootDir() . $this->filename);
    }

    /**
     * Upload file and set data of entity
     */
    private function uploadFile()
    {
        if (!$this->uploadedFile instanceof File) {
            return $this;
        }

        // On déplace le fichier envoyé dans le répertoire de notre choix
        $fileName = md5(uniqid()) . '.' . $this->uploadedFile->guessExtension();

        $this->file = $this->uploadedFile->move(
            $this->getUploadRootDir(),
            $fileName
        );
        $this->uploadedFile = null;

        $this->mimeType = $this->file->getMimeType();
        $this->filename = $fileName;

        return $this;
    }

    /**
     * Get the upload root dir and create it if not exists
     */
    private function getUploadRootDir()
    {
        if (empty($this->path)) {
            $date = new DateTime();
            $this->path = '/attachments/' . $date->format('Y/m/d') . '/';
        }

        $rootDir = __DIR__ . '/../../../var' . $this->path;

        if (!file_exists($rootDir)) {
            mkdir($rootDir, 0777, true);
        }

        return $rootDir;
    }

    /**
     * Get the file extension
     *
     * @return string
     */
    public function getExtension()
    {
        if (isset($this->file)) {
            return $this->file->guessExtension();
        }
        return null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}