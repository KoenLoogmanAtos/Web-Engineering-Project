<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Booking;
use App\Form\BookingType;

/**
 * @Route("/booking", name="booking")
 */
class BookingController extends Controller
{
    /**
     * @Route("/{id}", requirements={"id"="\d{1,10}"}, name="_view")
     */
    public function view($id)
    {
        $entity = $this->getDoctrine()->getRepository(Booking::class)->find($id);

        return $this->render('booking/view.html.twig', [
            'type' => 'booking',
            'entity' => $entity,
        ]);
    }

    /**
     * @Route("/edit/{id}", requirements={"id"="\d{1,10}"}, name="_edit")
     */
    public function edit($id, Request $request)
    {
        $entity = $this->getDoctrine()->getRepository(Booking::class)->find($id);

        $form = $this->createForm(BookingType::class, $entity, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $form->getData();

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                $this->addFlash(
                    'success',
                    'Successfully edited '.$entity
                );

                return $this->redirectToRoute('booking_view', ['id' => $id]);
            } catch (\Exception $e) {
                $this->addFlash(
                    'danger',
                    'booking.edit.failed'
                );
            }
        }

        return $this->render('booking/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", methods={"DELETE"}, requirements={"id"="\d{1,10}"}, name="_delete")
     */
    public function delete($id)
    {
        $entity = $this->getDoctrine()->getRepository(Booking::class)->find($id);
        
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
        
            $this->addFlash(
                'success',
                'Successfully deleted '.$entity
            );
        } catch(\Exception $e) {
            $this->addFlash(
                'danger',
                'booking.delete.failed'
            );
        }

        return $this->redirectToRoute('booking_manage');
    }

    /**
     * @Route("/manage", name="_manage")
     */
    public function manage(Request $request)
    {
        $booking = new Booking();

        $form = $this->createForm(BookingType::class, $booking, array(
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
