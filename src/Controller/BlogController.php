<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
use App\Entity\Category;


class BlogController extends AbstractController
{

    /**
     * Show all row from article's entity
     *
     * @Route("/", name="blog_index")
     * @return Response A response instance
     */

    public function index() : Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        if (!$articles){
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render(
            'blog/index.html.twig',
            ['articles' => $articles]
        );
    }

    /**
     * @Route("/article/{title}", name="article_show")
     */
    public function showOne(Article $article) :Response
    {
        return $this->render('blog/article.html.twig', ['article'=>$article]);
    }

    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("/{slug<^[a-z0-9-]+$>}",
     *     defaults={"slug" = null},
     *     name="blog_show")
     *  @return Response A response instance
     */
    public function show($slug) : Response
    {
        if (!$slug) {
            throw $this
            ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        if (!$article){
            throw $this->createNotFoundException(
                'No article with'.$slug.'title, found in article\'s table.'
            );
        }

        // $slug will equal the dynamic part of the URL
        // e.g. at /blog/yay-routing, then $slug='yay-routing'
       // $slug = str_replace('-', ' ', $slug);
        //$slug = ucwords ($slug);
        return $this->render('blog/show.html.twig', [
                   'article' => $article,
                    'slug' => $slug,
               ]);

    }

    /**

     * @Route("blog/category/{category}", name="blog_show_category")
     * @param string $category
     * @return
     */

    public function showByCategory(string $category)
    {
        $categoryId = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneByName($category)->getId();

        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                array('category' => $categoryId),
                array('id' => 'desc'),
                3
            );

        return $this->render('blog/category.html.twig', ['articles' => $articles, 'categorie' => $category]);
    }

    /**
     * @param string $category
     * @return Response
     * @Route("blog/category/{category}/all", name="blog_show_category_all")
     */
    public function showAllByCategory(string $category)
    {

        $articles = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneByName($category)->getArticles();


        return $this->render('blog/category.html.twig', ['articles' => $articles, 'categorie' => $category]);
    }
}
