<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Controller\JmsController;
use Symfony\Component\HttpFoundation\Request;
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
        $data = array("request" => $request->query);

        $rooms = $this->getDoctrine()->getRepository(Room::class)->findAll();
        $data["reports"] = $rooms;

        return $this->jms_json($data);
    }

    /**
     * @Route("/{id}", methods={"GET"}, requirements={"id"="\d{1,10}"}, name="api_room_show")
     */
    public function show($id)
    {
        $data = array("request" => array("id" => $id));

        $room = $this->getDoctrine()->getRepository(Room::class)->find($id);
        $data["reports"] = array($room);

        return $this->jms_json($data);
    }

    /**
     * @Route("/{id}", methods={"PUT"}, requirements={"id"="\d{1,10}"}, name="api_room_edit")
     */
    public function edit($id, Request $request)
    {
        $data = array("request" => array("id" => $id) + $request->request->get("form"));

        //TODO form and database interaction

        return $this->jms_json($data);
    }

    /**
     * @Route(methods={"POST"}, name="api_room_create")
     */
    public function create(Request $request)
    {
        $data = array("request" => $request->request->get("form"));

        //TODO form and database interaction

        return $this->jms_json($data);
    }

    /**
     * @Route("/{id}", methods={"DELETE"}, requirements={"id"="\d{1,10}"}, name="api_room_delete")
     */
    public function delete($id)
    {
        $data = array("request" => array("id" => $id));

        $room = $this->getDoctrine()->getRepository(Room::class)->find($id);
        //TODO delete entity

        return $this->jms_json($data);
    }
}
