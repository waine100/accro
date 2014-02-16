<?php

namespace Zenweb\Aventure\ParcBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parc
 */
class Parc
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $mail;

    /**
     * @var string
     */
    private $image = null;

    private $fileImage;

    private $filePlan;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Parc
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
     * Set description
     *
     * @param string $description
     * @return Parc
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Parc
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Parc
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Parc
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Display a nice name
     * @return string
     */
    public function __toString(){
        return $this->name;
    }
    /**
     * @var boolean
     */
    private $enabled;


    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Parc
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
    /**
     * @var string
     */
    private $plan;


    /**
     * Set plan
     *
     * @param string $plan
     * @return Parc
     */
    public function setPlan($plan)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan
     *
     * @return string 
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * @param mixed $fileImage
     */
    public function setFileImage($fileImage)
    {
        $this->fileImage = $fileImage;
    }

    /**
     * @return mixed
     */
    public function getFileImage()
    {
        return $this->fileImage;
    }

    /**
     * @param mixed $filePlan
     */
    public function setFilePlan($filePlan)
    {
        $this->filePlan = $filePlan;
    }

    /**
     * @return mixed
     */
    public function getFilePlan()
    {
        return $this->filePlan;
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/media';
    }

    public function getAbsoluteImage()
    {
        return null === $this->image ? null : $this->getUploadRootDir().'/'.$this->image;
    }

    public function getWebImage()
    {
        return null === $this->image ? null : $this->getUploadDir().'/'.$this->image;
    }

    public function getAbsolutePlan()
    {
        return null === $this->plan ? null : $this->getUploadRootDir().'/'.$this->plan;
    }

    public function getWebPlan()
    {
        return null === $this->plan ? null : $this->getUploadDir().'/'.$this->plan;
    }

    public function preUpload()
    {
        if (null !== $this->fileImage) {
            $this->image = sha1(uniqid(mt_rand(), true)).'.'.$this->fileImage->guessExtension();
        }
        if (null !== $this->filePlan) {
            $this->plan = sha1(uniqid(mt_rand(), true)).'.'.$this->filePlan->guessExtension();
        }
    }

    public function upload()
    {
        if (null !== $this->fileImage) {
            $this->fileImage->move($this->getUploadRootDir(), $this->image);
            unset($this->fileImage);
        }

        if (null !== $this->filePlan) {
            $this->filePlan->move($this->getUploadRootDir(), $this->plan);
            unset($this->filePlan);
        }
    }

    public function removeUpload()
    {
        if ($file = $this->getAbsoluteImage()) {
            unlink($file);
        }
        if ($file = $this->getAbsolutePlan()) {
            unlink($file);
        }
    }
}
