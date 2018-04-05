<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UIController extends Controller
{
    /**
     * @Route("/u/i", name="u_i")
     */
    public function index()
    {
        return $this->render('ui/index.html.twig', [
            'controller_name' => 'UIController',
        ]);
    }
}
