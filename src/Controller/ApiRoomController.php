<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Controller\JmsController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RoomType;
use App\Entity\Room;

/**
 * @Route("api/rooms")
 */
class ApiRoomController extends JmsController
{
    /**
     * @Route(methods={"GET", "HEAD"}, name="api_room_index")
     */
    public function index(Request $request)
    {
        $data = array();

        $rooms = array();
        $rooms = $this->getDoctrine()->getRepository(Room::class)->findAll();
        $data["reports"] = $rooms;

        return $this->jms_json($data);
    }

    /**
     * @Route("/{id}", methods={"GET"}, requirements={"id"="\d{1,10}"}, name="api_room_show")
     */
    public function show($id)
    {
        $data = array();

        $room = $this->getDoctrine()->getRepository(Room::class)->find($id);
        $data["reports"] = array($room);

        return $this->jms_json($data);
    }

    /**
     * @Route(methods={"POST"}, name="api_room_create")
     */
    public function create(Request $request)
    {
        $data = array();

        $room = new Room();
        $form = $this->createForm(RoomType::class, $room);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $room = $form->getData();

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($room);
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
     * @Route("/{id}", methods={"PUT"}, requirements={"id"="\d{1,10}"}, name="api_room_edit")
     */
    public function edit($id, Request $request)
    {
        $data = array();

        $room = $this->getDoctrine()->getRepository(Room::class)->find($id);
        $form = $this->createForm(RoomType::class, $room);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $room = $form->getData();
            
            try {
                $em = $this->getDoctrine()->getManager();
                $em->merge($room);
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
     * @Route("/{id}", methods={"DELETE"}, requirements={"id"="\d{1,10}"}, name="api_room_delete")
     */
    public function delete($id)
    {
        $data = array();

        $room = $this->getDoctrine()->getRepository(Room::class)->find($id);
        
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($room);
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
