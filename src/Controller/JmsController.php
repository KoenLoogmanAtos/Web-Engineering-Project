<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class JmsController extends Controller
{
    /**
     * Serializes with the jms serializer and returns the json with the corresponding header.
     */
    public function jms_json($data, $code = 200) {
        $serializer = $this->container->get('jms_serializer');
        $json = $serializer->serialize($data, 'json');

        $response = new Response($json, $code);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
