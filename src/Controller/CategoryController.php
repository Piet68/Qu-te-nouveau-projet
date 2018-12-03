<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="category_show")
     */

    public function categoryById(Category $category) :Response{

        return $this->render('category/index.html.twig',
            ['category' => $category]);
    }

    /**
     * @Route("/blog/category", name="category")
     */
    public function show(Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();
        }

        return $this->render('category/create.html.twig',
            ['form' => $form->createView()
        ]);
    }
}
