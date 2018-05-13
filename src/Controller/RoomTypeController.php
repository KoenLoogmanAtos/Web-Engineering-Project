<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\RoomType;
use App\Form\RoomTypeType;

/**
 * @Route("/room/type", name="room_type")
 */
class RoomTypeController extends Controller
{
    /**
     * @Route("/{id}", requirements={"id"="\d{1,10}"}, name="_view")
     */
    public function view($id)
    {
        $entity = $this->getDoctrine()->getRepository(RoomType::class)->find($id);

        return $this->render('room_type/view.html.twig', [
            'type' => 'room_type',
            'entity' => $entity,
        ]);
    }

    /**
     * @Route("/edit/{id}", requirements={"id"="\d{1,10}"}, name="_edit")
     */
    public function edit($id, Request $request)
    {
        $entity = $this->getDoctrine()->getRepository(RoomType::class)->find($id);

        $form = $this->createForm(RoomTypeType::class, $entity, array(
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

                return $this->redirectToRoute('room_type_view', ['id' => $id]);
            } catch (\Exception $e) {
                $this->addFlash(
                    'danger',
                    'room_type.edit.failed'
                );
            }
        }

        return $this->render('room_type/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", methods={"DELETE"}, requirements={"id"="\d{1,10}"}, name="_delete")
     */
    public function delete($id)
    {
        $entity = $this->getDoctrine()->getRepository(RoomType::class)->find($id);
        
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
                'room_type.delete.failed'
            );
        }

        return $this->redirectToRoute('room_type_manage');
    }

    /**
     * @Route("/manage", name="_manage")
     */
    public function manage(Request $request)
    {
        $roomType = new RoomType();

        $form = $this->createForm(RoomTypeType::class, $roomType, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $roomType = $form->getData();

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($roomType);
                $em->flush();

                $this->addFlash(
                    'success',
                    'Successfully created '.$roomType
                );

                return $this->redirectToRoute('room_type_manage');
            } catch (\Exception $e) {
                $this->addFlash(
                    'danger',
                    'room_type.create.failed'
                );
            }
        }

        $roomTypes = $this->getDoctrine()->getRepository(RoomType::class)->findAll();

        return $this->render('admin/manage.html.twig', [
            'type' => 'room_type',
            'primary' => 'id',
            'entities' => $roomTypes,
            'form' => $form->createView(),
            'display' => [
                'id' => 'primary',
                'type' => 'text',
                'capacity' => 'text',
                'created' => 'date',
                'updated' => 'date'
            ]
        ]);
    }
}
