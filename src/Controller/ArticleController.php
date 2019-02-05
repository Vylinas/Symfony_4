<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;

/**
 * @Route("/article")
 */
class ArticleController extends AbstractController 
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var ArticleRepository
     */
    private $repository;
    
    public function __construct(ObjectManager $em, ArticleRepository $repository)
    {
        $this->em = $em;
        $this->repository = $repository;
    }
    /**
     * @Route("/", 
     *      name    = "article.all",
     *      methods = {"GET"}
     * )
     */
    public function getArticleAll() 
    {
        $articles = $this->repository->findAll();
        return $this->render('article/list_article.html.twig',[
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/{id}",
     *      name    ="article",
     *      methods = {"GET"}
     * )
     */
    public function getArticle(Article $article) 
    {
        return $this->render('article/article.detail.html.twig', [
            'article' => $article,
        ]);
    }   
}