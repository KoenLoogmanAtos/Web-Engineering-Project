<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;

/**
 * @Route("/user", name="user")
 */
class UserController extends Controller
{
    /**
     * @Route("", name="_index")
     */
    public function index(UserInterface $user)
    {
        return $this->render('user/index.html.twig', [
            'user' => $user,
        ]);
    }
}
