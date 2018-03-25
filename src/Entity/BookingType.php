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
     * ORM\Column(type="string", length=32)
     */
    private $type;

    /**
     * ORM\Column(type="boolean")
     */
    private $can_expire;

    /**
     * ORM\Column(type="boolean")
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
     * Get oRM\Column(type="string", length=32)
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set oRM\Column(type="string", length=32)
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }



    /**
     * Get oRM\Column(type="boolean")
     */ 
    public function getCan_expire()
    {
        return $this->can_expire;
    }

    /**
     * Set oRM\Column(type="boolean")
     *
     * @return  self
     */ 
    public function setCan_expire($can_expire)
    {
        $this->can_expire = $can_expire;

        return $this;
    }



    /**
     * Get oRM\Column(type="boolean")
     */ 
    public function getDummy()
    {
        return $this->dummy;
    }

    /**
     * Set oRM\Column(type="boolean")
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
