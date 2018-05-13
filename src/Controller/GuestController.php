<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Guest;
use App\Form\GuestType;

/**
 * @Route("/guest", name="guest")
 */
class GuestController extends Controller
{
    /**
     * @Route("/{id}", requirements={"id"="\d{1,10}"}, name="_view")
     */
    public function view($id)
    {
        $entity = $this->getDoctrine()->getRepository(Guest::class)->find($id);

        return $this->render('guest/view.html.twig', [
            'type' => 'guest',
            'entity' => $entity,
        ]);
    }

    /**
     * @Route("/edit/{id}", requirements={"id"="\d{1,10}"}, name="_edit")
     */
    public function edit($id, Request $request)
    {
        $entity = $this->getDoctrine()->getRepository(Guest::class)->find($id);

        $form = $this->createForm(GuestType::class, $entity, array(
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

                return $this->redirectToRoute('guest_view', ['id' => $id]);
            } catch (\Exception $e) {
                $this->addFlash(
                    'danger',
                    'guest.edit.failed'
                );
            }
        }

        return $this->render('guest/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", methods={"DELETE"}, requirements={"id"="\d{1,10}"}, name="_delete")
     */
    public function delete($id)
    {
        $entity = $this->getDoctrine()->getRepository(Guest::class)->find($id);
        
        try {
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
                'guest.delete.failed'
            );
        }

        return $this->redirectToRoute('guest_manage');
    }


    /**
     * @Route("/manage", name="_manage")
     */
    public function manage(Request $request)
    {
        $guest = new Guest();

        $form = $this->createForm(GuestType::class, $guest, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $guest = $form->getData();
            
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($guest);
                $em->flush();

                $this->addFlash(
                    'success',
                    'Successfully created '.$guest
                );
                
                return $this->redirectToRoute('guest_manage');
            } catch (\Exception $e) {
                $this->addFlash(
                    'danger',
                    'guest.create.failed'
                );
            }
        }

        $guests = $this->getDoctrine()->getRepository(Guest::class)->findAll();

        return $this->render('admin/manage.html.twig', [
            'type' => 'guest',
            'primary' => 'id',
            'entities' => $guests,
            'form' => $form->createView(),
            'display' => [
                'id' => 'primary',
                'firstname' => 'text',
                'lastname' => 'text',
                'email' => 'text',
                'updated' => 'date'
            ]
        ]);
    }
}
