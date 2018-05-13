<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Room;
use App\Form\RoomType;

/**
 * @Route("/room", name="room")
 */
class RoomController extends Controller
{
    /**
     * @Route("/{id}", requirements={"id"="\d{1,10}"}, name="_view")
     */
    public function view($id)
    {
        $entity = $this->getDoctrine()->getRepository(Room::class)->find($id);

        return $this->render('room/view.html.twig', [
            'type' => 'room',
            'entity' => $entity,
        ]);
    }

    /**
     * @Route("/edit/{id}", requirements={"id"="\d{1,10}"}, name="_edit")
     */
    public function edit($id, Request $request)
    {
        $entity = $this->getDoctrine()->getRepository(Room::class)->find($id);

        $form = $this->createForm(RoomType::class, $entity, array(
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

                return $this->redirectToRoute('room_view', ['id' => $id]);
            } catch (\Exception $e) {
                $this->addFlash(
                    'danger',
                    'room.edit.failed'
                );
            }
        }

        return $this->render('room/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", methods={"DELETE"}, requirements={"id"="\d{1,10}"}, name="_delete")
     */
    public function delete($id)
    {
        $entity = $this->getDoctrine()->getRepository(Room::class)->find($id);
        
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
                'room.delete.failed'
            );
        }

        return $this->redirectToRoute('room_manage');
    }


    /**
     * @Route("/manage", name="_manage")
     */
    public function manage(Request $request)
    {
        $room = new Room();

        $form = $this->createForm(RoomType::class, $room, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $room = $form->getData();
            
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($room);
                $em->flush();

                $this->addFlash(
                    'success',
                    'Successfully created '.$room
                );
                    
                return $this->redirectToRoute('room_manage');
            } catch (\Exception $e) {
                $this->addFlash(
                    'danger',
                    'room.create.failed'
                );
            }
        }

        $rooms = $this->getDoctrine()->getRepository(Room::class)->findAll();
        
        return $this->render('admin/manage.html.twig', [
            'type' => 'room',
            'primary' => 'id',
            'entities' => $rooms,
            'form' => $form->createView(),
            'display' => [
                'id' => 'primary',
                'name' => 'text',
                'updated' => 'date'
            ]
        ]);
    }
}
