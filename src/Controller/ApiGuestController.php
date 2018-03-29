<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Controller\JmsController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\GuestType;
use App\Entity\Guest;

/**
 * @Route("api/guests", name="api_guest")
 */
class ApiGuestController extends JmsController
{
    /**
     * @Route(methods={"GET", "HEAD"}, name="_index")
     */
    public function index(Request $request)
    {
        $data = array();

        $guests = array();
        $guests = $this->getDoctrine()->getRepository(Guest::class)->findAll();
        $data["reports"] = $guests;

        return $this->jms_json($data);
    }

    /**
     * @Route("/{id}", methods={"GET"}, requirements={"id"="\d{1,10}"}, name="_show")
     */
    public function show($id)
    {
        $data = array();

        $guest = $this->getDoctrine()->getRepository(Guest::class)->find($id);
        $data["reports"] = array($guest);

        return $this->jms_json($data);
    }

    /**
     * @Route(methods={"POST"}, name="_create")
     */
    public function create(Request $request)
    {
        $data = array();

        $guest = new Guest();
        $form = $this->createForm(GuestTy::class, $guest, array(
            'method' => 'post'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $guest = $form->getData();

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($guest);
                $em->flush();
                $data["message"] = "Successfully created";
            } catch(\Exception $e) {
                $data["message"] = "Failed to create";

                //TODO cleaner error handling
                $data["error"] = $e->getMessage();
            }
        }

        return $this->jms_json($data);
    }

    /**
     * @Route("/{id}", methods={"PUT"}, requirements={"id"="\d{1,10}"}, name="_edit")
     */
    public function edit($id, Request $request)
    {
        $data = array();

        $guest = $this->getDoctrine()->getRepository(Guest::class)->find($id);
        $form = $this->createForm(GuestTy::class, $guest, array(
            'method' => 'put'
        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $guest = $form->getData();
            
            try {
                $em = $this->getDoctrine()->getManager();
                $em->merge($guest);
                $em->flush();
                $data["message"] = "Update was successful";
            } catch(\Exception $e) {
                $data["message"] = "Update failed";

                //TODO cleaner error handling
                $data["error"] = $e->getMessage();
            }
        }

        return $this->jms_json($data);
    }

    /**
     * @Route("/{id}", methods={"DELETE"}, requirements={"id"="\d{1,10}"}, name="_delete")
     */
    public function delete($id)
    {
        $data = array();

        $guest = $this->getDoctrine()->getRepository(Guest::class)->find($id);
        
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($guest);
            $em->flush();
            $data["message"] = "Successfully deleted";
        } catch(\Exception $e) {
            $data["message"] = "Failed to delete";

            //TODO cleaner error handling
            $data["error"] = $e->getMessage();
        }

        return $this->jms_json($data);
    }
}
