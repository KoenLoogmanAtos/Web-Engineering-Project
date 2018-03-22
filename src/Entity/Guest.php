<?php

namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GuestRepository")
 */
class Guest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * ORM\Column(type="string", length=64)
     */
    private $firstname;

    /**
     * ORM\Column(type="string", length=64)
     */
    private $lastname;

    /**
     * ORM\Column(type="string", length=128)
     */
    private $email;

    /**
     * ORM\Column(type="string", length=324)
     */
    private $phone;

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
     * Get oRM\Column(type="string", length=64)
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set oRM\Column(type="string", length=64)
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get oRM\Column(type="string", length=64)
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set oRM\Column(type="string", length=64)
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get oRM\Column(type="string", length=128)
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set oRM\Column(type="string", length=128)
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get oRM\Column(type="string", length=324)
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set oRM\Column(type="string", length=324)
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

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
