<?php

namespace App\Controller\User\Home;

use App\Repository\BungalowRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// class HomeController extends AbstractController
// {
//     #[Route('/user/home', name: 'user_home_index', methods: ['GET'])]
//     public function index(Request $request, BungalowRepository $bungalowRepository): Response
//     {
//         $selectedBungalowId = $request->query->get('selected_bungalow_id');

//         $selectedBungalow = null;
//         if ($selectedBungalowId) {
//             $selectedBungalow = $bungalowRepository->find($selectedBungalowId);
//             // Récupérer le chemin de l'image du bungalow sélectionné
//             $selectedBungalowImage = $selectedBungalow ? $selectedBungalow->getImagePath() : null;
//         }

//         $welcomeMessage = 'Bienvenue sur votre tableau de bord';
//         $lastLogin = new \DateTime(); // Utilisez la date/heure actuelle ou une logique personnalisée

//         // Utilisez l'injection de dépendances pour récupérer les bungalows
//         $bungalows = $bungalowRepository->findBy(['activation' => true]);

//         return $this->render('vers/user/home/index.html.twig', [
//             'lastLogin' => $lastLogin,
//             'welcomeMessage' => $welcomeMessage,
//             'bungalows' => $bungalows,
//             'selectedBungalowImage' => $selectedBungalowImage,
//         ]);
//     }

//     #[Route('/user/home/{id}', name: 'user_home_bungalow', methods: ['GET'])]
//     public function showBungalow($id, BungalowRepository $bungalowRepository): Response
//     {
//         // Récupérer le bungalow à partir du repository
//         $bungalow = $bungalowRepository->find($id);
        
//         // Assurer que le bungalow existe
//         if (!$bungalow) {
//             // Gérer l'erreur, par exemple, rediriger vers une page d'erreur ou afficher un message
//             throw $this->createNotFoundException('Le bungalow demandé n\'existe pas.');
//         }

//         return $this->render('vers/user/home/show_bungalow.html.twig', [
//             'bungalow' => $bungalow,
//         ]);
//     }
// }




class HomeController extends AbstractController
{
    #[Route('/user/home', name: 'user_home_index', methods: ['GET'])]
    public function index(Request $request, BungalowRepository $bungalowRepository): Response
    {
        $selectedBungalowId = $request->query->get('selected_bungalow_id');

        $selectedBungalow = null;
        $imageName = null; // Définissez la variable $imageName avec une valeur par défaut

        if ($selectedBungalowId) {
            $selectedBungalow = $bungalowRepository->find($selectedBungalowId);
            // Vérifiez si le bungalow sélectionné existe
            if ($selectedBungalow) {
                // Obtenez l'ID du bungalow sélectionné
                $bungalowId = $selectedBungalow->getId();
                // Générez le nom de l'image en utilisant l'ID du bungalow
                $imageName = 'bungalow' . $bungalowId . '.jpg';
            }
        }

        $welcomeMessage = 'Bienvenue sur votre tableau de bord';
        $lastLogin = new \DateTime(); // Utilisez la date/heure actuelle ou une logique personnalisée

        // Utilisez l'injection de dépendances pour récupérer les bungalows
        $bungalows = $bungalowRepository->findBy(['activation' => true]);

        return $this->render('vers/user/home/index.html.twig', [
            'lastLogin' => $lastLogin,
            'welcomeMessage' => $welcomeMessage,
            'selectedBungalow' => $selectedBungalow,
            'imageName' => $imageName, 
            'bungalows' => $bungalows,
        ]);
    }   
 

    #[Route('/user/home/{id}', name: 'user_home_bungalow', methods: ['GET'])]
    public function showBungalow($id, BungalowRepository $bungalowRepository): Response
    {
        // Récupérer le bungalow à partir du repository
        $bungalow = $bungalowRepository->find($id);
        
        // Assurer que le bungalow existe
        if (!$bungalow) {
            // Gérer l'erreur, par exemple, rediriger vers une page d'erreur ou afficher un message
            throw $this->createNotFoundException('Le bungalow demandé n\'existe pas.');
        }

        return $this->render('vers/user/home/show_bungalow.html.twig', [
            'bungalow' => $bungalow,
        ]);
    }
}