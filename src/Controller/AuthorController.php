<?php


namespace App\Controller;

use App\Entity\Article;
use App\Entity\Author;
use App\Form\Type\AuthorType;
use Symfony\Component\HttpFoundation\Request;
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

        $articles = $this->getDoctrine()->getRepository(Article::class)->findBy(['author' => $id]);

        return $this->render('/authors/show.html.twig', array('author' => $author, 'articles' => $articles));
    }

    /**
     * @param Request $request
     * @Route("create/author", name="app_create_validate_author")
     */
    public function createValidateAuthor(Request $request)
    {
        $author = new Author();
        $author = $author->setJoinDate(new \DateTime('now'));

        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $author = $form->getData();

            $authortocheck = $this->getDoctrine()->getRepository(Author::class)->findOneBy(['email' => $author->getEmail()]);

            if (!empty($authortocheck))
            {
                return $this->redirectToRoute('app_create_article', ['id' => $id = $authortocheck->getAuthorid()]);
            }


            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($author);
            $entityManager->flush();

            return $this->redirectToRoute('app_create_article', ['id' => $id = $author->getAuthorid()]);
        }

        return $this->render('create/create-validate-author.html.twig', ['form' => $form->createView()]);
    }
}