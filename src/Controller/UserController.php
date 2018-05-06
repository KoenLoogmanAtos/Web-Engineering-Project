<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Booking;

/**
 * @Route("/user", name="user")
 */
class UserController extends Controller
{
    /**
     * @Route("", name="_index")
     */
    public function index()
    {
        $from = new \DateTime();
        $to = new \DateTime();
        $to->add(new \DateInterval('P3M'));

        $em = $this->getDoctrine()->getManager();
        $bookings = $em->getRepository(Booking::class)->findByDateRange($from, $to);
        return $this->render('user/index.html.twig', [
            'bookings' => $bookings,
        ]);
    }
}
