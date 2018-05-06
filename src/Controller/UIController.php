<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/ui/", name="ui")
 */
class UIController extends Controller
{
    /**
     * @Route("index", name="_index")
     */
    public function index()
    {
        return $this->render('ui/index.html.twig', [
            'controller_name' => 'UIController',
        ]);
    }

    /**
     * @Route("rooms", name="_rooms")
     */
    public function rooms()
    {
        return $this->render('ui/rooms.html.twig', [
            'message' => 'Welcome!!!',
        ]);
    }
}
