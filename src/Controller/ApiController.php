<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    private $data = array(
        "reports" => array(),
    );

    public function addReports() {}

    /**
     * Serializes with the jms serializer and returns the json with the corresponding header.
     */
    public function jms_json($data = null, $code = 200) {
        if (!$data) {
            $data = $this->data;
        }

        $serializer = $this->container->get('jms_serializer');
        $json = $serializer->serialize($data, 'json');

        $response = new Response($json, $code);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
