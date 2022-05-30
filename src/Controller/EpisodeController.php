<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EpisodeController extends AbstractController
{
    #[Route('/episode', name: 'app_episode')]
    public function index(): Response
    {
        return $this->render('episode/index.html.twig', [
            'controller_name' => 'EpisodeController',
        ]);
    }

    #[Route('/program/{programId}/season/{seasonId}/episode/{episodeId}', methods:['GET'], name: 'program_episode_show')]
    public function show(Season $seasonId, Program $programId, Episode $episode): Response
    {

        return $this->render('program/episode_show.html.twig', [
            'season'=>$seasonId,
            'program'=>$programId,
            'episode'=>$episode,
        ]);
    }

    
    
}
