<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Services\MarkdownTransformers;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventsController extends AbstractController
{
    /**
     * @Route("/events", name="events")
     */
    public function index(EventRepository $repository,MarkdownTransformers $markdownTransformers): Response
    {
      $somemarkdown = "# Je suis du _code_ **markdown** !";

      $valueCache = $markdownTransformers->parse($somemarkdown);

        $events = $repository->findAll();

        return $this->render('events/index.html.twig', compact("events","valueCache"));
    }
}
