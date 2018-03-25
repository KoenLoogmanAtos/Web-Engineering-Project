<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiBookingTypeController extends Controller
{
    /**
     * @Route("/api/booking/type", name="api_booking_type")
     */
    public function index()
    {
        return $this->render('api_booking_type/index.html.twig', [
            'controller_name' => 'ApiBookingTypeController',
        ]);
    }
}
