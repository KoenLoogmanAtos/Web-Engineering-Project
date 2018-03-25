<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\JmsController;
use App\Form\BookingTypeType;
use App\Entity\BookingType;

/**
 * @Route("/api/booking/type", name="api_booking_type")
 */
class ApiBookingTypeController extends JmsController
{
    /**
     * @Route(methods={"GET", "HEAD"}, name="api_booking_type_index")
     */
    public function index(Request $request)
    {
        $data = array();

        $bookingTypes = array();
        $bookingTypes = $this->getDoctrine()->getRepository(BookingType::class)->findAll();
        $data["reports"] = $bookingTypes;

        return $this->jms_json($data);
    }

    /**
     * @Route("/{id}", methods={"GET"}, requirements={"id"="\d{1,10}"}, name="api_booking_type_show")
     */
    public function show($id)
    {
        $data = array();

        $bookingType = $this->getDoctrine()->getRepository(BookingType::class)->find($id);
        $data["reports"] = array($bookingType);

        return $this->jms_json($data);
    }

    /**
     * @Route(methods={"POST"}, name="api_booking_type_create")
     */
    public function create(Request $request)
    {
        $data = array();

        $bookingType = new BookingType();
        $form = $this->createForm(BookingTypeType::class, $bookingType);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookingType = $form->getData();

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($bookingType);
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
     * @Route("/{id}", methods={"PUT"}, requirements={"id"="\d{1,10}"}, name="api_booking_type_edit")
     */
    public function edit($id, Request $request)
    {
        $data = array();

        $bookingType = $this->getDoctrine()->getRepository(BookingType::class)->find($id);
        $form = $this->createForm(BookingTypeType::class, $bookingType);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookingType = $form->getData();
            
            try {
                $em = $this->getDoctrine()->getManager();
                $em->merge($bookingType);
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
     * @Route("/{id}", methods={"DELETE"}, requirements={"id"="\d{1,10}"}, name="api_booking_type_delete")
     */
    public function delete($id)
    {
        $data = array();

        $bookingType = $this->getDoctrine()->getRepository(BookingType::class)->find($id);
        
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bookingType);
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