<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\BookingType;
use App\Form\BookingTypeType as BookingTypeForm;

/**
 * @Route("/booking/type", name="booking_type")
 */
class BookingTypeController extends Controller
{
    /**
     * @Route("", name="_index")
     */
    public function index()
    {
        return $this->render('booking_type/index.html.twig', [
            'controller_name' => 'BookingTypeController',
        ]);
    }

    /**
     * @Route("/manage", name="_manage")
     */
    public function manage(Request $request)
    {
        $bookingType = new BookingType();

        $form = $this->createForm(BookingTypeForm::class, $bookingType, array(
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
                    'Successfully created '.$bookingType->getType()
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
                'created' => 'date',
                'updated' => 'date'
            ]
        ]);
    }
}
