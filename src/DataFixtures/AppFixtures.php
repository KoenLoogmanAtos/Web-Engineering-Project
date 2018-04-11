<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Entity\Guest;
use App\Entity\BookingType;
use App\Entity\Booking;
use App\Entity\RoomType;
use App\Entity\Room;

class AppFixtures extends Fixture
{
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // create admin
        $user = new User();
        $user->setUsername("admin");
        $user->setPlainPassword("admin");
        $user->setEmail("admin@no-mail.com");
        $password = $this->encoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        $user->setRoles(array('ROLE_ADMIN'));
        $manager->persist($user);

        // create user
        $user = new User();
        $user->setUsername("user");
        $user->setPlainPassword("user");
        $user->setEmail("user@no-mail.com");
        $password = $this->encoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        $user->setRoles(array('ROLE_USER'));
        $manager->persist($user);

        // booking types
        $bookingTypes = array();

        $bookingTypes[0] = new BookingType();
        $bookingTypes[0]->setType("Booking");
        $manager->persist($bookingTypes[0]);

        $bookingTypes[1] = new BookingType();
        $bookingTypes[1]->setType("Reservation");
        $bookingTypes[1]->setCanExpire(true);
        $manager->persist($bookingTypes[1]);

        $bookingTypes[2] = new BookingType();
        $bookingTypes[2]->setType("Blocked");
        $bookingTypes[2]->setDummy(true);
        $manager->persist($bookingTypes[2]);

        // room types
        $roomTypes = array();
        for ($i = 0; $i < 5; $i++) {
            $roomTypes[$i] = new RoomType();
            $roomTypes[$i]->setType('roomType '.$i);
            $roomTypes[$i]->setCapacity(random_int(1,6));
            $manager->persist($roomTypes[$i]);
        }

        // rooms
        $rooms = array();
        for ($i = 0; $i < 15; $i++) {
            $validFrom = new \DateTime();
            $validFrom->sub(new \DateInterval('P'.random_int(1,10).'D'));

            $validTo = new \DateTime();
            $validTo->sub(new \DateInterval('P'.random_int(2,6).'Y'.random_int(9,12).'M'.random_int(1,10).'D'));

            $rooms[$i] = new Room();
            $rooms[$i]->setName('room '.$i);
            $rooms[$i]->setRoomType($roomTypes[mt_rand(0, count($roomTypes) - 1)]);
            $rooms[$i]->setValidFrom($validFrom);
            $rooms[$i]->setValidTo($validTo);
            $manager->persist($rooms[$i]);
        }

        // guests
        $guests = array();
        $firstnames = array('Max', 'Helga', 'Dora', 'Helmut', 'Karl', 'Tom', 'Aleyna');
        $lastnames = array('Fischer', 'Mustermann', 'Kader', 'Kruse', 'Stroetmann');
        for ($i = 0; $i < 20; $i++) {
            $fn = $firstnames[mt_rand(0, count($firstnames) - 1)];
            $ln = $lastnames[mt_rand(0, count($lastnames) - 1)];
            $guests[$i] = new Guest();
            $guests[$i]->setFirstname($fn);
            $guests[$i]->setLastname($ln);
            $guests[$i]->setEmail(strtolower($fn.'.'.$ln.'@no-mail.com'));
            $guests[$i]->setPhone('0'.random_int(1249872349,1999999999));
            $manager->persist($guests[$i]);
        }

        $manager->flush();
    }
}

?>