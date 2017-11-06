<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 06/11/2017
 * Time: 15:24
 */

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * Upload
 *
 * @ORM\Table(name="upload")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UploadRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Upload
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
     * @var UploadedFile
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
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
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
     * @param File|Upload $uploadedFile
     */
    public function setUploadedFile(File $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;

        $this->filename = null;
        $this->path = null;
    }

    /**
     * @return UploadedFile
     */
    public function getUploadedFile()
    {
        return $this->uploadedFile;
    }

    // --- CALLBACKS

    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->uploadFile();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->uploadFile();
    }

    /**
     * @ORM\PostRemove()
     */
    public function postRemove()
    {
        $this->deleteFile();
    }

    /**
     * @ORM\PostLoad()
     */
    public function postLoad()
    {
        $this->loadFile();
    }

    // --- ACTIONS

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

        // Remove old file
        $this->deleteFile();

        $this->file = $this->uploadedFile->move(
            $this->getUploadRootDir(),
            $fileName
        );
        $this->filename = $fileName;

        $this->uploadedFile = null;

        return $this;
    }

    /**
     * Remove file
     *
     * @return $this
     */
    private function deleteFile()
    {
        if (isset($this->file) && $this->file instanceof File) {
            $fs = new Filesystem();
            $fs->remove($this->file);
        }

        $this->file = null;

        return $this;
    }

    /**
     * @return $this
     */
    private function loadFile()
    {
        $this->setFile(new File($this->getUploadRootDir() . $this->filename));

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

        $rootDir = __DIR__ . '/../../../web' . $this->path;

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
        if ($this->file instanceof File) {
            return $this->file->guessExtension();
        }
        return null;
    }

    /**
     * Get the mime type of file
     *
     * @return null|string
     */
    public function getMimeType()
    {
        if ($this->file instanceof File) {
            return $this->file->getMimeType();
        }
        return null;
    }
}