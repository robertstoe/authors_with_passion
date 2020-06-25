<?php


namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route ("/", name="app_homepage")
     */
    public function homepage()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findAll();

        return $this->render('homepage.html.twig', array('articles'=> $articles));
    }

    /**
     * @Route ("/article/{id}", name="app_article_show")
     */
    public function show($id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        return $this->render('articles/show.html.twig', array('article'=>$article));
    }
}
