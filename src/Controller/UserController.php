<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;
use App\Entity\User;

/**
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/create", name="user_create")
     */
    public function create()
    {
        // creates a task and gives it some dummy data for this example
        $user = new User();
        
        $form = $this->createForm(UserType::class, $user, array(
            "action" =>$this->generateUrl('api_user_create'),
            "method" => "POST"
        ));

        return $this->render('user/new.html.twig', array(
            "form" => $form->createView(),
        ));
    }
}
