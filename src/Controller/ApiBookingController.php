<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\JmsController;
use App\Form\BookingType;
use App\Entity\Booking;

/**
 * @Route("/api/booking", name="api_booking")
 */
class ApiBookingController extends JmsController
{
    /**
     * @Route(methods={"GET", "HEAD"}, name="_index")
     */
    public function index()
    {
        $data = array();

        $bookings = array();
        $bookings = $this->getDoctrine()->getRepository(Booking::class)->findAll();
        $data["reports"] = $bookings;

        return $this->jms_json($data);
    }

    /**
     * @Route("/{id}", methods={"GET"}, requirements={"id"="\d{1,10}"}, name="_show")
     */
    public function show($id)
    {
        $data = array("request" => array("id" => $id));

        $booking = $this->getDoctrine()->getRepository(Booking::class)->find($id);
        $data["reports"] = array($booking);

        return $this->jms_json($data);
    }

    /**
     * @Route(methods={"POST"}, name="_create")
     */
    public function create(Request $request)
    {
        $data = array();

        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking, array(
            'method' => 'post'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $booking = $form->getData();

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($booking);
                $em->flush();
                $data["message"] = "Successfully created";
            } catch(\Exception $e) {
                $data["message"] = "Failed to create";

                //TODO cleaner error handling
                $data["error"] = $e->getMessage();
            }
        }

        return $this->jms_json($data);
    }

    /**
     * @Route("/{id}", methods={"PUT"}, requirements={"id"="\d{1,10}"}, name="_edit")
     */
    public function edit($id, Request $request)
    {
        $data = array();

        $booking = $this->getDoctrine()->getRepository(Booking::class)->find($id);
        $form = $this->createForm(BookingType::class, $booking, array(
            'method' => 'put'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $booking = $form->getData();
            
            try {
                $em = $this->getDoctrine()->getManager();
                $em->merge($booking);
                $em->flush();
                $data["message"] = "Update was successful";
            } catch(\Exception $e) {
                $data["message"] = "Update failed";

                //TODO cleaner error handling
                $data["error"] = $e->getMessage();
            }
        }

        return $this->jms_json($data);
    }

    /**
     * @Route("/{id}", methods={"DELETE"}, requirements={"id"="\d{1,10}"}, name="_delete")
     */
    public function delete($id)
    {
        $data = array();

        $booking = $this->getDoctrine()->getRepository(Booking::class)->find($id);
        
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($booking);
            $em->flush();
            $data["message"] = "Successfully deleted";
        } catch(\Exception $e) {
            $data["message"] = "Failed to delete";

            //TODO cleaner error handling
            $data["error"] = $e->getMessage();
        }

        return $this->jms_json($data);
    }
}
