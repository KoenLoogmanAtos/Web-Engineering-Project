<?php

namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Room
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $roomType;

    /**
     * @ORM\Column(type="string", length=64, unique=true)
     */
    private $name;

    /**
     * @var \DateTime $validFrom
     *
     * @ORM\Column(type="datetime")
     */
    private $validFrom;

    /**
     * @var \DateTime $validTo
     *
     * @ORM\Column(type="datetime")
     */
    private $validTo;

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
     * Get the value of roomType
     */ 
    public function getRoomType()
    {
        return $this->roomType;
    }

    /**
     * Set the value of roomType
     *
     * @return  self
     */ 
    public function setRoomType($roomType)
    {
        $this->roomType = $roomType;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get $validFrom
     *
     * @return  \DateTime
     */ 
    public function getValidFrom()
    {
        return $this->validFrom;
    }

    /**
     * Set $validFrom
     *
     * @param  \DateTime  $validFrom  $validFrom
     *
     * @return  self
     */ 
    public function setValidFrom(\DateTime $validFrom)
    {
        $this->validFrom = $validFrom;

        return $this;
    }

    /**
     * Get $validTo
     *
     * @return  \DateTime
     */ 
    public function getValidTo()
    {
        return $this->validTo;
    }

    /**
     * Set $validTo
     *
     * @param  \DateTime  $validTo  $validTo
     *
     * @return  self
     */ 
    public function setValidTo(\DateTime $validTo)
    {
        $this->validTo = $validTo;

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