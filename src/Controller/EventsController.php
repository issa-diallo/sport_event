<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Michelf\MarkdownInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Cache\CacheInterface;

class EventsController extends AbstractController
{
    /**
     * @Route("/events", name="events")
     */
    public function index(CacheInterface $cache,EventRepository $repository,MarkdownInterface $markdown): Response
    {
      $html = $markdown->transform("# Je suis du _code_ **markdown** !");

        $events = $repository->findAll();

        return $this->render('events/index.html.twig', compact("events","html"));
    }
}
