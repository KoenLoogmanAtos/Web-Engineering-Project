<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiBookingController extends Controller
{
    /**
     * @Route("/api/booking", name="api_booking")
     */
    public function index()
    {
        return $this->render('api_booking/index.html.twig', [
            'controller_name' => 'ApiBookingController',
        ]);
    }
}
