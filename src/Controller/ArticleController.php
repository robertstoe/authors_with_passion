<?php


namespace App\Controller;

use App\Entity\Article;
use App\Entity\Author;
use App\Entity\Tag;
use App\Form\Type\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route ("/", name="app_homepage")
     */
    public function homepage()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findBy([],['creationDate' => 'DESC']);

        return $this->render('homepage.html.twig', array('articles'=> $articles));
    }

    /**
     * @Route("/test", name="app_test")
     */
    public function testing()
    {
        return $this->render('test.html.twig');
    }

    /**
     * @param Request $request
     * @Route("/create/article/{id}", name="app_create_article")
     */
    public function createArticle(Request $request, $id)
    {
        $article = new Article();
        $author = $this->getDoctrine()->getRepository(Author::class)->find($id);

        $article->setCreationDate(new \DateTime('now'));
        $article->setAuthor($author);

        $group = $this->getDoctrine()->getRepository(Tag::class)->findAll();

        $form = $this->createForm(ArticleType::class, $article
            //, array('data' => $group)
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $article = $form->getData();

            $tag = $this->getDoctrine()->getRepository(Tag::class)->find(3);
            $article->addTag($tag);

            //dd($article->getTags());
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            //$entityManager->persist($article->getTags());
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('app_article_show', ['id' => $article->getArticleid()]);
        }

        return $this->render('create/create-article.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route ("/article/{id}", name="app_article_show")
     */
    public function show($id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        return $this->render('articles/show.html.twig', array('article'=>$article, 'author'=>$article->getAuthor(), 'tags'=>$article->getTags()));
    }
}
