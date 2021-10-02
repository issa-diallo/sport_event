<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/events/api", name="api")
     */
    public function index(EntityManagerInterface $em): Response
    {

      dump($em);
        return $this->json([
        'status' => true,
        'message'=> 'Welcome to Json !',
        ]);
    }
}
