<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Guest;
use App\Form\GuestType as GuestForm;

/**
 * @Route("/guest", name="guest")
 */
class GuestController extends Controller
{
    /**
     * @Route("", name="_index")
     */
    public function index()
    {
        return $this->render('guest/index.html.twig', [
            'controller_name' => 'GuestController',
        ]);
    }

    /**
     * @Route("/manage", name="_manage")
     */
    public function manage(Request $request)
    {
        $guest = new Guest();

        $form = $this->createForm(GuestForm::class, $guest, array(
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
                    'Successfully created '.$guest->getDisplay()
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
                'created' => 'date',
                'updated' => 'date'
            ]
        ]);
    }
}
