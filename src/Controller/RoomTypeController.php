<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\RoomType;
use App\Form\RoomTypeType;

class RoomTypeController extends Controller
{
    /**
     * @Route("/room/type", name="room_type")
     */
    public function index()
    {
        $roomTypes = $this->getDoctrine()->getRepository(RoomType::class)->findAll();

        $roomType = new RoomType();
        $editForm = $this->createForm(RoomTypeType::class, $roomType, array(
            'action' => $this->generateUrl('api_room_type_edit', ["id" => 0]),
            'method' => 'PUT',
        ));

        return $this->render('room_type/index.html.twig', [
            'roomTypes' => $roomTypes,
            'editForm' => $editForm->createView(),
        ]);
    }
}
