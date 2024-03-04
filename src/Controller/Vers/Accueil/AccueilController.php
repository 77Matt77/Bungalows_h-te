<?php

namespace App\Controller\Vers\Accueil;

use App\Repository\BungalowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'vers_accueil_index', methods: ['GET'])]
    public function index(BungalowRepository $bungalowRepository): Response
    {
        
        // Récupérer tous les bungalows activés depuis le repository
        $bungalow = $bungalowRepository->findBy(['activation' => true]);

        // Rendre la vue Twig en passant les bungalows récupérés
        return $this->render('vers/accueil/index.html.twig', [
            'bungalows' => $bungalow,
        ]);
    }
    
}
