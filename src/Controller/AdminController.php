<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Booking;
use App\Entity\Room;
use App\Entity\RoomType;
use App\Entity\BookingType;
use App\Entity\Guest;
use App\Form\RoomType as RoomForm;
use App\Form\RoomTypeType as RoomTypeForm;
use App\Form\BookingType as BookingForm;
use App\Form\BookingTypeType as BookingTypeForm;
use App\Form\GuestType as GuestForm;
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

        $rooms = $this->getDoctrine()->getRepository(Room::class)->findAll();

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
/**
     * @Route("/booking/type", name="_booking_type")
     */
    public function bookingType(Request $request)
    {
        $bookingType = new BookingType();

        $createForm = $this->createForm(BookingTypeForm::class, $bookingType, array(
            'method' => 'POST',
        ));

        $createForm->handleRequest($request);
        if ($createForm->isSubmitted() && $createForm->isValid()) {
            $roomType = $createForm->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($bookingype);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully created '.$bookingType->getType()
            );
            return $this->redirectToRoute('admin_booking_type');
        }

        $bookingTypes = $this->getDoctrine()->getRepository(BookingType::class)->findAll();

        return $this->render('admin/booking_type.html.twig', [
            'bookingTypes' => $bookingTypes,
            'createForm' => $createForm->createView()
        ]);
    }
    
     /**
     * @Route("/guest", name="_guest")
     */
    public function guest(Request $request)
    {

        $guest = new Guest();

        $createForm = $this->createForm(GuestForm::class, $guest, array(
            'method' => 'POST',
        ));

        $createForm->handleRequest($request);
        if ($createForm->isSubmitted() && $createForm->isValid()) {
            $guest = $createForm->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully created '.$guest->getDisplay()
            );
            return $this->redirectToRoute('admin_guest');
        }

        $guests = $this->getDoctrine()->getRepository(Guest::class)->findAll();


        return $this->render('admin/guest.html.twig', [
            'guests' => $guests,
            'createForm' => $createForm->createView()
        ]);
    }
}
