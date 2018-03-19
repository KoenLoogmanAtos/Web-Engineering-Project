<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiGuestController extends Controller
{
    /**
     * @Route("/api/guest", name="api_guest")
     */
    public function index()
    {
        return $this->render('api_guest/index.html.twig', [
            'controller_name' => 'ApiGuestController',
        ]);
    }
}
