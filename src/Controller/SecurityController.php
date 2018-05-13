<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Form\NewPasswordType;
use App\Form\RegistrationType;
use App\Entity\User;

class SecurityController extends Controller
{
    /**
     * @Route("/register", name="registration")
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $this->addFlash(
                    'success',
                    'register.successful'
                );

                return $this->redirectToRoute('login');
            } catch (\Exception $e) {
                $this->addFlash(
                    'danger',
                    'register.failed'
                );
            }
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("user/new-password", name="user_password")
     */
    public function newPassword(Request $request, UserInterface $user, UserPasswordEncoderInterface $encoder) {
        $form = $this->createForm(NewPasswordType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            
            try {
                $em = $this->getDoctrine()->getManager();
                $em->merge($user);
                $em->flush();

                $this->addFlash(
                    'success',
                    'password.change.successful'
                );
            } catch (\Exception $e) {
                $this->addFlash(
                    'danger',
                    'password.change.failed'
                );
            }
            return $this->redirectToRoute('user_password');
        }

        return $this->render('security/password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
