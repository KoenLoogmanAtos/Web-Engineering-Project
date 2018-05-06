<?php

namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Guest", inversedBy="bookings")
     */
    private $guest;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BookingType", inversedBy="bookings")
     */
    private $bookingType;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Room", inversedBy="bookings")
     */
    private $rooms;

    /**
     * @var \DateTime $arrival
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotNull()
     * @Assert\DateTime()
     */
    private $arrival;

    /**
     * @var \DateTime $depature
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotNull()
     * @Assert\DateTime()
     */
    private $depature;

    /**
     * @var \DateTime $expiration_date
     *
     * @ORM\Column(type="datetime")
     * @Assert\NotNull()
     * @Assert\DateTime()
     */
    private $expirationDate; 

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

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }
    
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of guest
     */ 
    public function getGuest()
    {
        return $this->guest;
    }

    /**
     * Set the value of guest
     *
     * @return  self
     */ 
    public function setGuest($guest)
    {
        $this->guest = $guest;

        return $this;
    }
    
    /**
     * Get the value of bookingType
     */ 
    public function getBookingType()
    {
        return $this->bookingType;
    }

    /**
     * Set the value of bookingType
     *
     * @return  self
     */ 
    public function setBookingType($bookingType)
    {
        $this->bookingType = $bookingType;

        return $this;
    }

    /**
     * Get the value of rooms
     */ 
    public function getRooms()
    {
        return $this->rooms;
    }

    /**
     * Get $arrival
     *
     * @return  \DateTime
     */ 
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * Set $arrival
     *
     * @param  \DateTime  $arrival  $arrival
     *
     * @return  self
     */ 
    public function setArrival(\DateTime $arrival)
    {
        $this->arrival = $arrival;

        return $this;
    }

    /**
     * Get $depature
     *
     * @return  \DateTime
     */ 
    public function getDepature()
    {
        return $this->depature;
    }

    /**
     * Set $depature
     *
     * @param  \DateTime  $depature  $depature
     *
     * @return  self
     */ 
    public function setDepature(\DateTime $depature)
    {
        $this->depature = $depature;

        return $this;
    }

    /**
     * Get the value of nights
     */ 
    public function getNights()
    {
        return $this->nights;
    }

    /**
     * Get $expiration_date
     *
     * @return  \DateTime
     */ 
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * Set $expiration_date
     *
     * @param  \DateTime  $expirationDate  $expiration_date
     *
     * @return  self
     */ 
    public function setExpirationDate(\DateTime $expirationDate)
    {
        $this->expirationDate = $expirationDate;

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
