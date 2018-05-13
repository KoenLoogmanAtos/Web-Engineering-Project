<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Booking;
use App\Form\BookingType as BookingForm;

/**
 * @Route("/booking", name="booking")
 */
class BookingController extends Controller
{
    /**
     * @Route("", name="_index")
     */
    public function index()
    {
        return $this->render('booking/index.html.twig', [
            'controller_name' => 'BookingController',
        ]);
    }

    /**
     * @Route("/manage", name="_manage")
     */
    public function manage(Request $request)
    {
        $booking = new Booking();

        $form = $this->createForm(BookingForm::class, $booking, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $booking = $form->getData();
    
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($booking);
                $em->flush();

                $this->addFlash(
                    'success',
                    'booking.create.successful'
                );

                return $this->redirectToRoute('booking_manage');
            } catch (\Exception $e) {
                $this->addFlash(
                    'danger',
                    'booking.create.failed'
                );
            }
        }

        $bookings = $this->getDoctrine()->getRepository(Booking::class)->findAll();

        return $this->render('admin/manage.html.twig', [
            'type' => 'booking',
            'primary' => 'id',
            'entities' => $bookings,
            'form' => $form->createView(),
            'display' => [
                'id' => 'primary',
                'bookingType' => 'text',
                'guest' => 'text',
                'arrival' => 'date',
                'depature' => 'date',
                'nights' => 'text'
            ]
        ]);
    }
}
