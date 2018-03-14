<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

        $form = $this->createFormBuilder($user)
            ->setAction($this->generateUrl('api_user_create'))
            ->setMethod('POST')
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->add('create', SubmitType::class, array('label' => 'Create User'))
            ->getForm();

        return $this->render('user/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
