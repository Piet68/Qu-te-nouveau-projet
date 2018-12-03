<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category_show")
     */

    public function addCategory(Request $request, ObjectManager $manager) : Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $manager->persist($category);
            $manager->flush();

            return $this->redirectToRoute('category_show');
        }
        return $this->render(
            'category/create.html.twig', [
                'form' => $form->createView(),
            ]
        );
    }


/**
     * @Route("/blog/category/{id}", name="category")
     */
    public function show(Category $category): Response
    {
        return $this->render('category/index.html.twig', [
            'category' => $category
        ]);


    }
}
