<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\JmsController;
use App\Form\RoomTypeType;
use App\Entity\RoomType;

/**
 * @Route("/api/room/type", name="api_room_type")
 */
class ApiRoomTypeController extends JmsController
{
    /**
     * @Route(methods={"GET", "HEAD"}, name="api_room_type_index")
     */
    public function index()
    {
        $data = array();

        $roomTypes = array();
        $roomTypes = $this->getDoctrine()->getRepository(RoomType::class)->findAll();
        $data["reports"] = $roomTypes;

        return $this->jms_json($data);
    }

    /**
     * @Route("/{id}", methods={"GET"}, requirements={"id"="\d{1,10}"}, name="api_room_type_show")
     */
    public function show($id)
    {
        $data = array("request" => array("id" => $id));

        $roomType = $this->getDoctrine()->getRepository(RoomType::class)->find($id);
        $data["reports"] = array($roomType);

        return $this->jms_json($data);
    }

    /**
     * @Route(methods={"POST"}, name="api_room_type_create")
     */
    public function create(Request $request)
    {
        $data = array();

        $roomType = new RoomType();
        $form = $this->createForm(RoomTypeType::class, $roomType);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomType = $form->getData();

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($roomType);
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
     * @Route("/{id}", methods={"PUT"}, requirements={"id"="\d{1,10}"}, name="api_room_type_edit")
     */
    public function edit($id, Request $request)
    {
        $data = array();

        $roomType = $this->getDoctrine()->getRepository(RoomType::class)->find($id);
        $form = $this->createForm(RoomTypeType::class, $roomType);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomType = $form->getData();
            
            try {
                $em = $this->getDoctrine()->getManager();
                $em->merge($roomType);
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
     * @Route("/{id}", methods={"DELETE"}, requirements={"id"="\d{1,10}"}, name="api_room_type_delete")
     */
    public function delete($id)
    {
        $data = array();

        $roomType = $this->getDoctrine()->getRepository(RoomType::class)->find($id);
        
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($roomType);
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
