<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/manage", name="_manage")
     */
    public function manage(Request $request)
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('admin/manage.html.twig', [
            'type' => 'user',
            'primary' => 'id',
            'entities' => $users,
            'display' => [
                'id' => 'primary',
                'username' => 'text',
                'email' => 'text',
                'created' => 'date',
                'updated' => 'date'
            ]
        ]);
    }

    /**
     * @Route("/delete/{id}", methods={"DELETE"}, requirements={"id"="\d{1,10}"}, name="_delete")
     */
    public function delete($id)
    {
        $entity = $this->getDoctrine()->getRepository(User::class)->find($id);
        
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();
        } catch(\Exception $e) {
        }

        return $this->redirectToRoute('user_manage');
    }
}
