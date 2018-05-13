<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\BookingType;
use App\Form\BookingTypeType;

/**
 * @Route("/booking/type", name="booking_type")
 */
class BookingTypeController extends Controller
{
    /**
     * @Route("/{id}", requirements={"id"="\d{1,10}"}, name="_view")
     */
    public function view($id)
    {
        $entity = $this->getDoctrine()->getRepository(BookingType::class)->find($id);

        return $this->render('booking_type/view.html.twig', [
            'type' => 'booking_type',
            'entity' => $entity,
        ]);
    }

    /**
     * @Route("/edit/{id}", requirements={"id"="\d{1,10}"}, name="_edit")
     */
    public function edit($id, Request $request)
    {
        $entity = $this->getDoctrine()->getRepository(BookingType::class)->find($id);

        $form = $this->createForm(BookingTypeType::class, $entity, array(
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

                return $this->redirectToRoute('booking_type_view', ['id' => $id]);
            } catch (\Exception $e) {
                $this->addFlash(
                    'danger',
                    'booking_type.edit.failed'
                );
            }
        }

        return $this->render('booking_type/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", methods={"DELETE"}, requirements={"id"="\d{1,10}"}, name="_delete")
     */
    public function delete($id)
    {
        $entity = $this->getDoctrine()->getRepository(BookingType::class)->find($id);
        
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
                'booking_type.delete.failed'
            );
        }

        return $this->redirectToRoute('booking_type_manage');
    }

    /**
     * @Route("/manage", name="_manage")
     */
    public function manage(Request $request)
    {
        $bookingType = new BookingType();

        $form = $this->createForm(BookingTypeType::class, $bookingType, array(
            'method' => 'POST',
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $roomType = $form->getData();
            
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($bookingType);
                $em->flush();

                $this->addFlash(
                    'success',
                    'Successfully created '.$bookingType
                );

                return $this->redirectToRoute('booking_type_manage');
            } catch (\Exception $e) {
                $this->addFlash(
                    'danger',
                    'booking_type.create.failed'
                );
            }
        }

        $bookingTypes = $this->getDoctrine()->getRepository(BookingType::class)->findAll();

        return $this->render('admin/manage.html.twig', [
            'type' => 'booking',
            'primary' => 'id',
            'entities' => $bookingTypes,
            'form' => $form->createView(),
            'display' => [
                'id' => 'primary',
                'type' => 'text',
                'dummy' => 'text',
                'canExpire' => 'text',
                'updated' => 'date'
            ]
        ]);
    }
}
