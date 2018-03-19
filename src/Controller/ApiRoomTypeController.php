<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiRoomTypeController extends Controller
{
    /**
     * @Route("/api/room/type", name="api_room_type")
     */
    public function index()
    {
        return $this->render('api_room_type/index.html.twig', [
            'controller_name' => 'ApiRoomTypeController',
        ]);
    }
}
