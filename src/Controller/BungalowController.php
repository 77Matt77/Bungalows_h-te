<?php

namespace App\Controller;

use App\Entity\Bungalow;
use App\Form\BungalowType;
use App\Repository\BungalowRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/*
 MODEL (MVC)
 Entity = table
 Repository = Requête SELECT
 EntityManagerInterface = Requêtes INSERT INTO, UPDATE et DELETE
*/
#[Route('/bungalow')]
class BungalowController extends AbstractController
{
    #[Route('/', name: 'app_bungalow_index', methods: ['GET'])]
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

            return $this->redirectToRoute('app_bungalow_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bungalow/new.html.twig', [
            'bungalow' => $bungalow,
            'form' => $form,
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

            return $this->redirectToRoute('app_bungalow_index', [], Response::HTTP_SEE_OTHER);
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

        return $this->redirectToRoute('app_bungalow_index', [], Response::HTTP_SEE_OTHER);
    }
}
