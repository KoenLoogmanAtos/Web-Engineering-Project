<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Booking;
use App\Entity\Room;
use App\Entity\RoomType;
use App\Form\RoomType as RoomForm;
use App\Form\RoomTypeType as RoomTypeForm;
use App\Form\BookingType as BookingForm;

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
    public function room(Request $request)
    {
        $rooms = $this->getDoctrine()->getRepository(Room::class)->findAll();

        $room = new Room();

        $createForm = $this->createForm(RoomForm::class, $room, array(
            'method' => 'POST',
        ));

        $createForm->handleRequest($request);
        if ($createForm->isSubmitted() && $createForm->isValid()) {
            $room = $createForm->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($room);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully created '.$room->getName()
            );
            return $this->redirectToRoute('admin_room');
        }

        return $this->render('admin/room.html.twig', [
            'rooms' => $rooms,
            'createForm' => $createForm->createView()
        ]);
    }

    /**
     * @Route("/room/type", name="_room_type")
     */
    public function roomType(Request $request)
    {
        $roomType = new RoomType();

        $createForm = $this->createForm(RoomTypeForm::class, $roomType, array(
            'method' => 'POST',
        ));

        $createForm->handleRequest($request);
        if ($createForm->isSubmitted() && $createForm->isValid()) {
            $roomType = $createForm->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($roomType);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully created '.$roomType->getType()
            );
            return $this->redirectToRoute('admin_room_type');
        }

        $roomTypes = $this->getDoctrine()->getRepository(RoomType::class)->findAll();

        return $this->render('admin/room_type.html.twig', [
            'roomTypes' => $roomTypes,
            'createForm' => $createForm->createView()
        ]);
    }

    /**
     * @Route("/booking", name="_booking")
     */
    public function booking(Request $request)
    {
        $booking = new Booking();

        $createForm = $this->createForm(BookingForm::class, $booking, array(
            'method' => 'POST',
        ));

        $createForm->handleRequest($request);
        if ($createForm->isSubmitted() && $createForm->isValid()) {
            $booking = $createForm->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully created'
            );
            return $this->redirectToRoute('admin_room_type');
        }

        $bookings = $this->getDoctrine()->getRepository(Booking::class)->findAll();

        return $this->render('admin/booking.html.twig', [
            'bookings' => $bookings,
            'createForm' => $createForm->createView()
        ]);
    }
}
