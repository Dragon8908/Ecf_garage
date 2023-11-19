<?php

namespace App\Controller;

use App\Data\FiltreData;
use App\Form\FiltreType;
use App\Repository\VoitureRepository;
use App\Repository\HorairesRepository;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Voiture;
use App\Form\VoitureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class VoitureController extends AbstractController
{
    #[Route('/voiture', name: 'app_voiture')]
    public function index(VoitureRepository $voitureRepository,ContactRepository $contactRepository, HorairesRepository $horairesRepository, Request $request, PaginatorInterface $paginator,  SluggerInterface $slugger,EntityManagerInterface $entityManager): Response
    {
        $filtreData = new FiltreData();
        $filtreform = $this->createForm(FiltreType::class, $filtreData);
        $filtreform->handleRequest($request);

        [$prixmin, $prixmax, $kmmin, $kmmax, $anneemin, $anneemax] = $voitureRepository->findMinMax($filtreData);

        $pagination = $paginator->paginate(
            $voitureRepository->findSearch($filtreData),
            $request->query->getInt('page', 1),
            6
        );

        if ($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('voiture/index.html.twig', [
                'cars' => $pagination
                ])
            ]);
        }

        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $image = $form->get('image')->getData();
            if ($image) {
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension();
                $voiture->setImage($newFilename);
            }
            $entityManager->persist($voiture);
            $entityManager->flush();
        }

        return $this->render('voiture/index.html.twig', [
            'voitureForm' => $form->createView(),
            'cars' => $pagination,
            'horaires' => $horairesRepository->findBy([]),
            'voitures' => $voitureRepository->findBy([]),
            'contacts' => $contactRepository->findBy([]),
            'filtreform' => $filtreform->createView(),
            'prixmin' => $prixmin,
            'prixmax' => $prixmax,
            'kmmin' => $kmmin, 
            'kmmax' => $kmmax,
            'anneemin' => $anneemin,
            'anneemax' => $anneemax

        ]);
    }


    #[Route('/supprimer-voiture/{id<\d+>}', name: "app_supprimer_voiture")]
    public function delete(Voiture $voiture,EntityManagerInterface $entityManager) : Response
    {
        if ($this->isGranted('ROLE_USER')) {
            $entityManager->remove($voiture);
            $entityManager->flush();
        }
        return $this->redirectToRoute("app_voiture");
    }
    
}