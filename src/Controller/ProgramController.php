<?php
// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{

     #[Route('/program/{id}', requirements: ['page'=>'\d+'], methods: ['GET'], name:'program_show')]
     public function show(int $id): Response
     {
         return $this->render('program/id.html.twig', ['id' => $id]);
     }
}