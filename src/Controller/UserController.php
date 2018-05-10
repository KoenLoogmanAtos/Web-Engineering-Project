<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserInterface;

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

    public function newPassword(UserInterface $user) {
        $form = $this->createForm(NewPasswordType::class, $user, array(
            'method' => 'POST',
        ));
    }
}
