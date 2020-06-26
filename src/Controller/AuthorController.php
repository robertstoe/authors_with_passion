<?php


namespace App\Controller;

use App\Entity\Article;
use App\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class AuthorController extends AbstractController
{
    /**
     * @Route("/leaderboard", name="app_leaderboard")
     */
    public function leaderboard()
    {
        $authors = $this->getDoctrine()->getRepository(Author::class)->findAll();

        return $this->render('authors/leaderboard.html.twig', array('authors' => $authors));
    }

    /**
     * @Route("/author/{id}", name="app_author_show")
     */
    public function show($id)
    {
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);

        $articles = $this->getDoctrine()->getRepository(Article::class)->findBy(['authorid' => $id]);

        return $this->render('/authors/show.html.twig', array('author' => $author, 'articles' => $articles));
    }
}