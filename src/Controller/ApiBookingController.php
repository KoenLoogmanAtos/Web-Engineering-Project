<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\BookingType;
use App\Entity\Booking;

/**
 * @Route("/api/booking", name="api_booking")
 */
class ApiBookingController extends ApiController
{
    /**
     * @Route(methods={"GET", "HEAD"}, name="_index")
     */
    public function index()
    {
        $data = array();

        $entities = array();
        $entities = $this->getDoctrine()->getRepository(Booking::class)->findAll();
        $data["reports"] = $entities;

        return $this->jms_json($data);
    }

    /**
     * @Route("/{id}", methods={"GET"}, requirements={"id"="\d{1,10}"}, name="_show")
     */
    public function show($id)
    {
        $data = array();

        $entity = $this->getDoctrine()->getRepository(Booking::class)->find($id);
        $data["reports"] = array($entity);

        return $this->jms_json($data);
    }

    /**
     * @Route(methods={"POST"}, name="_create")
     */
    public function create(Request $request)
    {
        $data = array("alerts" => array());

        $entity = new Booking();
        $form = $this->createForm(BookingType::class, $entity, array(
            'method' => 'post'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $form->getData();

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                $data["reports"] = [$entity];
                
                array_push($data["alerts"], ["message" => "Successfully created"]);
            } catch(\Exception $e) {
                array_push($data["alerts"], ["message" => "Failed to create"]);

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
        $data = array("alerts" => array());

        $entity = $this->getDoctrine()->getRepository(Booking::class)->find($id);
        $form = $this->createForm(BookingType::class, $entity, array(
            'method' => 'put'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $form->getData();
            
            try {
                $em = $this->getDoctrine()->getManager();
                $em->merge($entity);
                $em->flush();

                $data["reports"] = [$entity];

                array_push($data["alerts"], ["message" => "Update was successful"]);
            } catch(\Exception $e) {
                array_push($data["alerts"], ["message" => "Update failed"]);

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
        $data = array("alerts" => array());

        $entity = $this->getDoctrine()->getRepository(Booking::class)->find($id);
        
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();

            $data["removes"] = [$id];

            array_push($data["alerts"], ["message" => "Successfully deleted"]);
        } catch(\Exception $e) {
            array_push($data["alerts"], ["message" => "Failed to delete"]);

            //TODO cleaner error handling
            $data["error"] = $e->getMessage();
        }

        return $this->jms_json($data);
    }
}
