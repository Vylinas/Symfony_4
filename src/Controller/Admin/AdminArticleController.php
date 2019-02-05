<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Article;
use App\Form\ArticleType;

/**
 * @Route("/admin/article")
 * @IsGranted("ROLE_ADMIN")
 */

class AdminArticleController extends AbstractController
{
    /**
     * @var EntityManager
     */
    private $em;
   
    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/add", 
     *      name    ="article.add",
     *      methods ={"GET", "POST"}
     * )
     * 
     * @param Request $request
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function add(Request $request): Response {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $article->setCreateAt(new \DateTime());
            $article->setEditedBy($this->getUser());

            $this->nameImage($article);
            $this->em->persist($article);
            $this->em->flush();

            return $this->redirectToRoute("success");
        }
        return $this->render('article/form_article.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/update/{id}",
     *      name    ="article.update",
     *      methods = {"GET","POST"}
     * )
     * 
     * @param Resquest
     * @return Response
     */
    public function update(Article $article, Request $request): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
            $article = $form->getData();
            $article->setEditedBy($this->getUser());
            $this->nameImage($article);

            $this->em->persist($article);
            $this->em->flush();

            return $this->redirectToRoute("success");
        }
        return $this->render('article/form_article.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}",
     *      name    = "article.update",
     *      methods = {"GET", "DELETE"}
     * )
     */
    public function delete(Article $article) 
    {
        $this->em->remove($article);
        $this->em->flush();
        return $this->redirectToRoute("success");
    }
    private function nameImage($image) 
    {
        dump($image);
    }
}