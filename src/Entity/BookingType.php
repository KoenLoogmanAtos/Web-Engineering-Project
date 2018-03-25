<?php

namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingTypeRepository")
 */
class BookingType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     */
    private $canExpire;

    /**
     * @ORM\Column(type="boolean")
     */
    private $dummy;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of canExpire
     */ 
    public function getCanExpire()
    {
        return $this->canExpire;
    }

    /**
     * Set the value of canExpire
     *
     * @return  self
     */ 
    public function setCanExpire($canExpire)
    {
        $this->canExpire = $canExpire;

        return $this;
    }

    /**
     * Get the value of dummy
     */ 
    public function getDummy()
    {
        return $this->dummy;
    }

    /**
     * Set the value of dummy
     *
     * @return  self
     */ 
    public function setDummy($dummy)
    {
        $this->dummy = $dummy;

        return $this;
    }

    /**
     * Get $created
     *
     * @return  \DateTime
     */ 
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get $updated
     *
     * @return  \DateTime
     */ 
    public function getUpdated()
    {
        return $this->updated;
    }
}