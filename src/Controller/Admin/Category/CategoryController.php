<?php

namespace App\Controller\Admin\Category;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/admin/category/list', name: 'admin_category_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('vers/admin/category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
}
