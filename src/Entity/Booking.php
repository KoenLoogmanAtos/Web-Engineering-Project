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
    private $guest_id;

     /**
     * @ORM\Column(type="integer")
     */
    private $booking_type_id;

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
    private $expiration_date; 

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
     * Get the value of guest_id
     */ 
    public function getGuest_id()
    {
        return $this->guest_id;
    }

    /**
     * Set the value of guest_id
     *
     * @return  self
     */ 
    public function setGuest_id($guest_id)
    {
        $this->guest_id = $guest_id;

        return $this;
    }



    /**
     * Get the value of booking_type_id
     */ 
    public function getBooking_type_id()
    {
        return $this->booking_type_id;
    }

    /**
     * Set the value of booking_type_id
     *
     * @return  self
     */ 
    public function setBooking_type_id($booking_type_id)
    {
        $this->booking_type_id = $booking_type_id;

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
    public function getExpiration_date()
    {
        return $this->expiration_date;
    }

    /**
     * Set $expiration_date
     *
     * @param  \DateTime  $expiration_date  $expiration_date
     *
     * @return  self
     */ 
    public function setExpiration_date(\DateTime $expiration_date)
    {
        $this->expiration_date = $expiration_date;

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
