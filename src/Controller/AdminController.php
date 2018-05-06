<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Booking;
use App\Entity\Room;
use App\Entity\RoomType;
use App\Form\RoomType as RoomForm;
use App\Form\RoomTypeType as RoomTypeForm;

/**
 * @Route("/admin", name="admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("", name="_index")
     */
    public function index()
    {
        $from = new \DateTime();
        $to = new \DateTime();
        $to->add(new \DateInterval('P3M'));

        $em = $this->getDoctrine()->getManager();
        $bookings = $em->getRepository(Booking::class)->findByDateRange($from, $to);

        return $this->render('admin/index.html.twig', [
            'bookings' => $bookings,
        ]);
    }


    /**
     * @Route("/room", name="_room")
     */
    public function room()
    {
        $rooms = $this->getDoctrine()->getRepository(Room::class)->findAll();

        $room = new Room();

        $createForm = $this->createForm(RoomForm::class, $room, array(
            'method' => 'POST',
        ));

        return $this->render('admin/room.html.twig', [
            'rooms' => $rooms,
            'createForm' => $createForm->createView()
        ]);
    }

    /**
     * @Route("/room/type", name="_room_type")
     */
    public function roomType()
    {
        $roomTypes = $this->getDoctrine()->getRepository(RoomType::class)->findAll();

        $roomType = new RoomType();

        $createForm = $this->createForm(RoomTypeForm::class, $roomType, array(
            'method' => 'POST',
        ));

        return $this->render('admin/room_type.html.twig', [
            'roomTypes' => $roomTypes,
            'createForm' => $createForm->createView()
        ]);
    }
}
