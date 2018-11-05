<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog/{page}", name="blog_list", requirements={"page"="\d+"})
     */
   // public function list()
    //{
       // return $this->render('blog/index.html.twig', [
            //'controller_name' => 'BlogController',
        //]);
   // }

    /**
     * @throws \Exception
     * Matches /blog/*
     * @Route("/blog/{slug}", name="blog_show", requirements={"slug"="[a-z0-9-]+"})
     */
    public function show($slug = "Article Sans Titre")
    {
        // $slug will equal the dynamic part of the URL
        // e.g. at /blog/yay-routing, then $slug='yay-routing'
        $slug = str_replace('-', ' ', $slug);
        $slug = ucwords ($slug);
        return $this->render('blog/index.html.twig', [
                   'slug' => $slug,
               ]);

    }
}
