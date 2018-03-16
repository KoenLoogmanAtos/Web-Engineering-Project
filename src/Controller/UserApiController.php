<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Controller\JmsController;
use App\Entity\User;
use App\Form\UserType;

/**
 * @Route("/api/users")
 */
class UserApiController extends JmsController
{
    /**
     * @Route(methods={"GET", "HEAD"}, name="api_user_index")
     */
    public function index(Request $request)
    {
        $data = array("request" => $request->query);

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
     * @Route("/{id}", methods={"PUT"}, requirements={"id"="\d{1,10}"}, name="api_user_edit")
     */
    public function edit($id, Request $request)
    {
        $data = array("request" => array("id" => $id) + $request->request->get("form"));

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $form = $this->createForm(UserTask::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            //TODO flush data to database and do some error handling
        }

        return $this->jms_json($data);
    }

    /**
     * @Route(methods={"POST"}, name="api_user_create")
     */
    public function create(Request $request)
    {
        $data = array("request" => $request->request->get("form"));

        $user = new User();
        $form = $this->createForm(UserTask::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($user);
            $manager->flush();
        }

        return $this->jms_json($data);
    }

    /**
     * @Route("/{id}", methods={"DELETE"}, requirements={"id"="\d{1,10}"}, name="api_user_delete")
     */
    public function delete($id)
    {
        $data = array("request" => array("id" => $id));

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        //TODO delete entity

        return $this->jms_json($data);
    }
}
