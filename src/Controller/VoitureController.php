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
    #[Route('/voiture', name: 'app_voiture', methods: ['GET'])]
    public function index(VoitureRepository $voitureRepository,ContactRepository $contactRepository, HorairesRepository $horairesRepository, Request $request, PaginatorInterface $paginator,  SluggerInterface $slugger,EntityManagerInterface $entityManager): Response
    {
        $filtreData = new FiltreData();
        $form = $this->createForm(FiltreType::class, $filtreData);
        $form->handleRequest($request);

        [$prixmin, $prixmax, $kmmin, $kmmax, $anneemin, $anneemax] = $voitureRepository->findMinMax($filtreData);

        $pagination = $paginator->paginate(
            $voitureRepository->findSearch($filtreData),
            $request->query->getInt('page', 1),
            6
        );

        if ($request->get('ajax')) {
            return new JsonResponse([
                'content' => $this->renderView('pages/cars/cars_list.html.twig', [
                'cars' => $pagination
                ])
            ]);
        }

        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $fichier = $form->get('fichier')->getData();
            if ($fichier) {
                $originalFilename = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $fichier->guessExtension();
                $voiture->setImage($newFilename);
            }
            $entityManager->persist($voiture);
            $entityManager->flush();
        }

        return $this->render('pages/cars/carscatalogue.html.twig', [
            'voitureForm' => $form->createView(),
            'cars' => $pagination,
            'horaires' => $horairesRepository->findBy([]),
            'voitures' => $voitureRepository->findBy([]),
            'contacts' => $contactRepository->findBy([]),
            'form' => $form->createView(),
            'prixmin' => $prixmin,
            'prixmax' => $prixmax,
            'kmmin' => $kmmin, 
            'kmmax' => $kmmax,
            'yearmin' => $anneemin,
            'yearmax' => $anneemax

        ]);
    }

    #[Route('/voiture', name: 'app_voiture', methods: ['GET'])]
    public function show(VoitureRepository $voitureRepository, HorairesRepository $horairesRepository, int $id): Response
    {
        $car = $voitureRepository->find($id);

        if (!$car) {
            throw $this->createNotFoundException('La voiture n\'existe pas.');
        }

        return $this->render('pages/cars/cars.html.twig', [
            'car' => $car,
            'horaires' => $horairesRepository->findBy([])
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