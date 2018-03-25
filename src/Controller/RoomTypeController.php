<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RoomTypeController extends Controller
{
    /**
     * @Route("/room/type", name="room_type")
     */
    public function index()
    {
        return $this->render('room_type/index.html.twig', [
            'controller_name' => 'RoomTypeController',
        ]);
    }
}
