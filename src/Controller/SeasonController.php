<?php

namespace App\Controller;

use App\Repository\EpisodeRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeasonController extends AbstractController
{
    #[Route('/season', name: 'app_season')]
    public function index(): Response
    {
        return $this->render('season/index.html.twig', [
            'controller_name' => 'SeasonController',
        ]);
    }

    #[Route('/program/{programId}/season/{seasonId}', methods:['GET'], name: 'season_show')]
    public function show(int $seasonId, EpisodeRepository $episodeRepository): Response
    {
        $episodes = $episodeRepository->findby(['season' => $seasonId]);


        return $this->render('program/season_show.html.twig', [

            'episodes'=>$episodes
        ]);
    }
}
