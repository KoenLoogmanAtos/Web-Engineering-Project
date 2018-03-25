<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BookingTypeController extends Controller
{
    /**
     * @Route("/booking/type", name="booking_type")
     */
    public function index()
    {
        return $this->render('booking_type/index.html.twig', [
            'controller_name' => 'BookingTypeController',
        ]);
    }
}
