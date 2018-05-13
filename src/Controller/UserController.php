<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;
use App\Form\UserType;

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
        return $this->render('user/view.html.twig', [
            'type' => 'user',
            'entity' => $user,
        ]);
    }

    /**
     * @Route("/{id}", requirements={"id"="\d{1,10}"}, name="_view")
     */
    public function view($id)
    {
        $entity = $this->getDoctrine()->getRepository(User::class)->find($id);

        return $this->render('user/view.html.twig', [
            'type' => 'user',
            'entity' => $entity,
        ]);
    }

    /**
     * @Route("/edit/{id}", requirements={"id"="\d{1,10}"}, name="_edit")
     */
    public function edit($id, Request $request)
    {
        $entity = $this->getDoctrine()->getRepository(User::class)->find($id);

        $form = $this->createForm(UserType::class, $entity, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $form->getData();

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                $this->addFlash(
                    'success',
                    'Successfully edited '.$entity
                );

                return $this->redirectToRoute('user_view', ['id' => $id]);
            } catch (\Exception $e) {
                $this->addFlash(
                    'danger',
                    'user.edit.failed'
                );
            }
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", methods={"DELETE"}, requirements={"id"="\d{1,10}"}, name="_delete")
     */
    public function delete($id, UserInterface $user)
    {
        $entity = $this->getDoctrine()->getRepository(User::class)->find($id);
        
        try {
            if ($user->getId() == $id) {
                throw new \Exception('user.delete.self');
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($entity);
            $em->flush();

            $this->addFlash(
                'success',
                'Successfully deleted '.$entity
            );
        } catch(\Exception $e) {
            $this->addFlash(
                'danger',
                'user.delete.failed'
            );
        }

        return $this->redirectToRoute('user_manage');
    }

    /**
     * @Route("/manage", name="_manage")
     */
    public function manage()
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
}
