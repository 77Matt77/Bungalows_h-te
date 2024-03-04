<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Exception\NotNullConstraintViolationException;

#[Route('/image')]
class ImageController extends AbstractController
{
    #[Route('/', name: 'app_image_index', methods: ['GET'])]
    public function index(ImageRepository $imageRepository): Response
    {
        $images = $imageRepository->findAll();

        return $this->render('image/index.html.twig', [
            'images' => $images,
        ]);
    }

    #[Route('/new', name: 'app_image_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $image = new Image();
    $form = $this->createForm(ImageType::class, $image);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Récupérer le fichier téléchargé
        $image = $form->get('image')->getData();

        // Vérifier si un fichier a été téléchargé
        if ($image) {
            // Générer un nom de fichier unique
            $fileName = md5(uniqid()).'.'.$image->guessExtension();

            // Déplacer le fichier téléchargé vers le répertoire de stockage des images
            $image->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            // Définir le nom du fichier téléchargé comme valeur du champ 'nom'
            $image->setNom($fileName);
        } else {
            // Si aucun fichier n'a été téléchargé, afficher un message d'erreur
            $this->addFlash('error', 'Veuillez sélectionner un fichier.');

            // Rediriger vers la page de création avec un message d'erreur
            return $this->redirectToRoute('app_image_new');
        }

        try {
            $entityManager->persist($image);
            $entityManager->flush();

            // Afficher un message de succès
            $this->addFlash('success', 'L\'image a été ajoutée avec succès.');
        } catch (\Exception $e) {
            // En cas d'erreur, afficher un message d'erreur
            $this->addFlash('error', 'Une erreur est survenue lors de l\'ajout de l\'image.');
        }

        return $this->redirectToRoute('app_image_index');
    }

    return $this->render('image/new.html.twig', [
        'image' => $image,
        'form' => $form->createView(),
    ]);
}

    

    #[Route('/{id}', name: 'app_image_show', methods: ['GET'])]
    public function show(Image $image): Response
    {
        return $this->render('image/show.html.twig', [
            'image' => $image,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_image_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Image $image, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('image/edit.html.twig', [
            'image' => $image,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_image_delete', methods: ['POST'])]
    public function delete(Request $request, Image $image, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->request->get('_token'))) {
            $entityManager->remove($image);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_image_index', [], Response::HTTP_SEE_OTHER);
    }
}







// use App\Entity\Image;
// use App\Form\ImageType;
// use App\Repository\ImageRepository;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;

// #[Route('/image')]
// class ImageController extends AbstractController
// {
//     #[Route('/', name: 'app_image_index', methods: ['GET'])]
//     public function index(ImageRepository $imageRepository): Response
//     {
//         $images = $imageRepository->findAll();

//         return $this->render('image/index.html.twig', [
//             'images' => $images,
//         ]);
//     }

//     #[Route('/new', name: 'app_image_new', methods: ['GET', 'POST'])]
//     public function new(Request $request, EntityManagerInterface $entityManager): Response
//     {
//         $image = new Image();
//         $form = $this->createForm(ImageType::class, $image);
//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             $entityManager->persist($image);
//             $entityManager->flush();

//             return $this->redirectToRoute('app_image_index', [], Response::HTTP_SEE_OTHER);
//         }

//         return $this->render('image/new.html.twig', [
//             'image' => $image,
//             'form' => $form->createView(),
//         ]);
//     }

//     #[Route('/{id}', name: 'app_image_show', methods: ['GET'])]
//     public function show(Image $image): Response
//     {
//         return $this->render('image/show.html.twig', [
//             'image' => $image,
//         ]);
//     }

//     #[Route('/{id}/edit', name: 'app_image_edit', methods: ['GET', 'POST'])]
//     public function edit(Request $request, Image $image, EntityManagerInterface $entityManager): Response
//     {
//         $form = $this->createForm(ImageType::class, $image);
//         $form->handleRequest($request);

//         try {
//             if ($form->isSubmitted() && $form->isValid()) {
//                 $entityManager->flush();

//                 return $this->redirectToRoute('app_image_index', [], Response::HTTP_SEE_OTHER);
//             }
//         } catch (\Exception $exception) {
//             $this->addFlash('error', 'Une erreur est survenue lors de la modification de l\'image.');
//         }

//         return $this->render('image/edit.html.twig', [
//             'image' => $image,
//             'form' => $form->createView(),
//         ]);
//     }

//     #[Route('/{id}', name: 'app_image_delete', methods: ['POST'])]
//     public function delete(Request $request, Image $image, EntityManagerInterface $entityManager): Response
//     {
//         if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->request->get('_token'))) {
//             $entityManager->remove($image);
//             $entityManager->flush();

//             $this->addFlash('success', 'L\'image a été supprimée avec succès.');
//         }

//         return $this->redirectToRoute('app_image_index');
//     }
// } 










