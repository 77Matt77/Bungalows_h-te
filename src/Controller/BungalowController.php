<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use App\Entity\Bungalow;
use App\Form\BungalowType;
use App\Repository\BungalowRepository;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/*
 MODEL (MVC)
 Entity = table
 Repository = Requête SELECT
 EntityManagerInterface = Requêtes INSERT INTO, UPDATE et DELETE
*/
#[Route('/bungalow')]
class BungalowController extends AbstractController
{
    #[Route('/bungalow', name: 'admin_bungalow_index', methods: ['GET'])]
    public function index(BungalowRepository $bungalowRepository): Response
    {
        return $this->render('bungalow/index.html.twig', [
            'bungalows' => $bungalowRepository->findAll(), // SELECT * FROM bungalow
        ]);
    }

    #[Route('/new', name: 'app_bungalow_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bungalow = new Bungalow();
        $form = $this->createForm(BungalowType::class, $bungalow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bungalow);
            $entityManager->flush();

            return $this->redirectToRoute('admin_bungalow_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bungalow/new.html.twig', [
            'bungalow' => $bungalow,
            'form' => $form,
        ]);
    }



    #[Route('/images/{id}', name: 'app_bungalow_images', methods: ['GET', 'POST'])]
    public function image(Bungalow $bungalow,Request $request, EntityManagerInterface $entityManager, ImageRepository $imageRepository): Response
    {
        $images = $imageRepository->findBy(['bungalow' => $bungalow]);
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('nom')->getData();
            /*
                S'il n'y a pas de chargement de fichier, $imageFile = null
                S'il y a un chargement de fichier, $imageFile retourne un objet de la class UploadedFile

            */

            if ($imageFile) {
                // 1e - Définir le nom du fichier
                $nomImage = date('YmdHis') . '-' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            
                // 2e - Enregistrer le fichier dans le dossier public sous le nom crée avant
                $imageFile->move(
                    $this->getParameter('bungalow'),
                    $nomImage
                );
            
                // 3e - Enregistrer le nom du fichier dans l'objet en bdd
                $image->setNom($nomImage);
            }
            $image->setBungalow($bungalow);
            $entityManager->persist($image);
            $entityManager->flush();

            return $this->redirectToRoute('app_bungalow_image', ['id' => $bungalow->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bungalow/images.html.twig', [
            'bungalow' => $bungalow,
            'form' => $form,
            'images' => $images
        ]);
    }
    
    
    
    
    #[Route('/{id}', name: 'app_bungalow_show', methods: ['GET'])]
    public function show(Bungalow $bungalow): Response
    {
        return $this->render('bungalow/show.html.twig', [
            'bungalow' => $bungalow,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bungalow_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bungalow $bungalow, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BungalowType::class, $bungalow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_bungalow_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bungalow/edit.html.twig', [
            'bungalow' => $bungalow,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bungalow_delete', methods: ['POST'])]
    public function delete(Request $request, Bungalow $bungalow, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bungalow->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bungalow);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_bungalow_index', [], Response::HTTP_SEE_OTHER);
    }
}
