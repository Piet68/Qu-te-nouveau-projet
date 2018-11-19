<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ListeArticleCategoryController extends AbstractController
{
    /**
     * @var ArticleRepository
     */
    private $article;
    /**
     * @var CategoryRepository
     */
    private $categorie;

    public function __construct(ArticleRepository $article, CategoryRepository $categorie)
    {
        $this->article = $article;
        $this->categorie = $categorie;
    }

    /**
     * @Route("/liste/index", name="liste_article_category")
     */
    public function index()
    {
        $listes = $this->article->findAll();
        $categories = $this->categorie->findAll();
        dump($listes);
        return $this->render('liste_article_category/index.html.twig', [
            'controller_name' => 'ListeArticleCategoryController', 'listes' => $listes, 'categories' => $categories,
        ]);
    }
}