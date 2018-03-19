<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\JmsController;
use App\Form\UserType;
use App\Entity\User;

/**
 * @Route("/api/users")
 */
class ApiUserController extends JmsController
{
    /**
     * @Route(methods={"GET", "HEAD"}, name="api_user_index")
     */
    public function index(Request $request)
    {
        $data = array();

        $users = array();
        if ($request->query->has("s")) {
            $users = $this->getDoctrine()->getRepository(User::class)->findByUsername($request->query->get("s"));
        } else {
            $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        }
        $data["reports"] = $users;

        return $this->jms_json($data);
    }

    /**
     * @Route("/{id}", methods={"GET"}, requirements={"id"="\d{1,10}"}, name="api_user_show")
     */
    public function show($id)
    {
        $data = array("request" => array("id" => $id));

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $data["reports"] = array($user);

        return $this->jms_json($data);
    }

    /**
     * @Route(methods={"POST"}, name="api_user_create")
     */
    public function create(Request $request)
    {
        $data = array();

        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
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
     * @Route("/{id}", methods={"PUT"}, requirements={"id"="\d{1,10}"}, name="api_user_edit")
     */
    public function edit($id, Request $request)
    {
        $data = array();

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            
            try {
                $em = $this->getDoctrine()->getManager();
                $em->merge($user);
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
     * @Route("/{id}", methods={"DELETE"}, requirements={"id"="\d{1,10}"}, name="api_user_delete")
     */
    public function delete($id)
    {
        $data = array();

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
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
