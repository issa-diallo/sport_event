<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventsController extends AbstractController
{
    /**
     * @Route("/events", name="events")
     */
    public function index(EventRepository $repository): Response
    {
        $events = $repository->findAll();

        return $this->render('events/index.html.twig', compact("events"));
    }
}
