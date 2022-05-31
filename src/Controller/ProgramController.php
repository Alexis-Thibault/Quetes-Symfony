<?php
// src/Controller/WildController.php
namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\ProgramType;
use App\Repository\EpisodeRepository;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use App\Service\Slugify;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{
    #[Route('/program', name: 'program_index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs]
        );
    }

    #[Route('/program/new', name: 'program_new')]
    public function new(Request $request, ProgramRepository $programRepository, Slugify $slugify): Response
    {

        $program = new Program();
        $slug = $slugify->generate($program->getTitle());
        $program->setSlug($slug);
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $programRepository->add($program, true);

            // Redirect to categories list
            return $this->redirectToRoute('program_index');
        }

        // Render the form  
        return $this->renderForm('program/new.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/show/{slug}', methods: ['GET'], name: 'program_show')]
    public function show(Program $program, SeasonRepository $seasonRepository): Response
    {



        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $program . ' found in program\'s table.'
            );
        }
        $seasons = $seasonRepository->findBy(['program' => $program]);

        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
        ]);
    }

    #[Route('/program/{slug}/season/{seasonId}', methods: ['GET'], name: 'season_show')]
    public function showSeason(int $seasonId, EpisodeRepository $episodeRepository): Response
    {
        $episodes = $episodeRepository->findby(['season' => $seasonId]);

        return $this->render('program/season_show.html.twig', [
            'episodes' => $episodes
        ]);
    }

    #[Route('/program/{slug}/season/{seasonId}/episode/{episodeId}', methods: ['GET'], name: 'program_episode_show')]

    public function showEpisode(Season $seasonId, Program $programId, Episode $episodeId): Response
    {

        return $this->render('program/episode_show.html.twig', [
            'seasons' => $seasonId,
            'program' => $programId,
            'episode' => $episodeId,
        ]);
    }
}
