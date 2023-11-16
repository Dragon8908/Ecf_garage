<?php

namespace App\Controller;

use App\Repository\HorairesRepository;
use App\Repository\TemoignageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(HorairesRepository $horairesRepository, TemoignageRepository $temoignageRepository): Response
    {
        return $this->render('accueil/index.html.twig', [
            'horaires' => $horairesRepository->findBy([]),
            'temoignages' => $temoignageRepository->findBy([]),
        ]);
    }
}