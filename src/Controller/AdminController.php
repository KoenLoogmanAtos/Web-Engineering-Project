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
        $room = new Room();

        $form = $this->createForm(RoomForm::class, $room, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $room = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($room);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully created '.$room->getName()
            );
            return $this->redirectToRoute('admin_room');
        }

        $rooms = $this->getDoctrine()->getRepository(Room::class)->findAll();
        
        return $this->render('admin/room.html.twig', [
            'rooms' => $rooms,
            'createForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/room/type", name="_room_type")
     */
    public function roomType(Request $request)
    {
        $roomType = new RoomType();

        $form = $this->createForm(RoomTypeForm::class, $roomType, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $roomType = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($roomType);
            $em->flush();

            $this->addFlash(
                'success',
                'room_type.create.successful '.$roomType->getType()
            );
            return $this->redirectToRoute('admin_room_type');
        }

        $roomTypes = $this->getDoctrine()->getRepository(RoomType::class)->findAll();

        return $this->render('admin/room_type.html.twig', [
            'roomTypes' => $roomTypes,
            'createForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/booking", name="_booking")
     */
    public function booking(Request $request)
    {
        $booking = new Booking();

        $form = $this->createForm(BookingForm::class, $booking, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $booking = $form->getData();
    
            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            $this->addFlash(
                'success',
                'room_type.create.successful'
            );
            return $this->redirectToRoute('admin_booking');
        }

        $bookings = $this->getDoctrine()->getRepository(Booking::class)->findAll();

        return $this->render('admin/booking.html.twig', [
            'bookings' => $bookings,
            'createForm' => $form->createView()
        ]);
    }
}
