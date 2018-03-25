<?php

namespace App\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="integer")
     */
    private $guestId;

     /**
     * @ORM\Column(type="integer")
     */
    private $bookingTypeId;

     /**
     * @var \DateTime $arrival
     *
     * @ORM\Column(type="datetime")
     */
    private $arrival;

    /**
     * @var \DateTime $depature
     *
     * @ORM\Column(type="datetime")
     */
    private $depature;

    /**
     * @ORM\Column(type="integer")
     */
    private $nights;

    /**
     * @var \DateTime $expiration_date
     *
     * @ORM\Column(type="datetime")
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

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of guestId
     */ 
    public function getGuestId()
    {
        return $this->guestId;
    }

    /**
     * Set the value of guestId
     *
     * @return  self
     */ 
    public function setGuestId($guestId)
    {
        $this->guestId = $guestId;

        return $this;
    }

    /**
     * Get the value of bookingTypeId
     */ 
    public function getBookingTypeId()
    {
        return $this->bookingTypeId;
    }

    /**
     * Set the value of bookingTypeId
     *
     * @return  self
     */ 
    public function setBookingTypeId($bookingTypeId)
    {
        $this->bookingTypeId = $bookingTypeId;

        return $this;
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
     * Set the value of nights
     *
     * @return  self
     */ 
    public function setNights($nights)
    {
        $this->nights = $nights;

        return $this;
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
