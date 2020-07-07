<?php


namespace App\Controller;

use App\Entity\Article;
use App\Entity\Author;
use App\Form\Type\ArticleType;
use App\Model\UserRating;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Annotation\Method;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ArticleController extends AbstractController
{
    private $serializer;

    public function __construct()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    /**
     * @Route ("/", name="app_homepage")
     */
    public function homepage()
    {
        $articles = $this->getDoctrine()->getRepository(Article::class)->findBy([],['creationDate' => 'DESC']);

        return $this->render('homepage.html.twig', array('articles'=> $articles));
    }

    /**
     * @Route("/article/upvote/{id}", name="app_article_upvote")
     */
    public function upvote(Request $request, $id)
    {
        $response = new Response('success');

        $jsonContent = $request->cookies->get('ratingValues' . $id);

        if($jsonContent == null)
        {
            $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

            $author = $article->getAuthor();

            $ratings = $author->getTotalScore();
            $votes = $author->getTotalVotes();

            $ratingValue = $request->get('value');

            $author = $author->setTotalScore($ratings + $ratingValue);
            $author = $author->setTotalVotes($votes + 1);

            $userrating = new UserRating();
            $userrating = $userrating->setRating($ratingValue);
            $userrating = $userrating->setArticleid($id);

            $jsonContent = $this->serializer->serialize($userrating, 'json');

            $cookie = new Cookie('ratingValues' . $id, $jsonContent, time()+31556926);
            $response->headers->setCookie($cookie);

            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush();
        }

        return $response;
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

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $article = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('app_article_show', ['id' => $article->getArticleid()]);
        }

        return $this->render('create/create-article.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @param Request $request
     * @Route ("/article/{id}", name="app_article_show")
     */
    public function show(Request $request, $id)
    {
        $jsonContent = $request->cookies->get('ratingValues' . $id);

        $userrating = null;

        if($jsonContent != null) {
            $userrating = $this->serializer->deserialize($jsonContent, 'App\Model\UserRating', 'json');
        }

        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);
/*
        $encrypt = $this->encrypt('testing123');
        dump($encrypt);
        $decrypt = $this->decrypt($encrypt);
        dump($decrypt);
*/

        return $this->render('articles/show.html.twig',
            array(
                'article'=>$article,
                'author'=>$article->getAuthor(),
                'tags'=>$article->getTags(),
                'rating' => $userrating
            ));
    }

    /**
     * @Route("/article/edit/{id}", name="app_article_edit")
     */
    public function edit(Request $request, $id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            dump($article);
            $article = $form->getData();
            //dd($article);
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $this->addFlash('success', 'Article Updated! Inaccuracies squashed!');

            return $this->redirectToRoute('app_article_show', ['id' => $article->getArticleid()]);
        }

        return $this->render('articles/edit.html.twig', ['form' => $form->createView()]);
    }
/*
    function encrypt($string) {
        $output = false;
        $encrypt_method = “AES-256-CBC”;
        $secret_key = ‘fe67d68ee1e09b47acd8810b880d537034c10c15344433a992b9c79002666844’;
        $secret_iv = ‘fdd3345455fffgffffhkkyoife67d68ee1e09b47acd8810b880d537034c10c15344433a992b9c79002666844’;

        $key = hash(‘sha256’, $secret_key);
        $iv = substr(hash(‘sha256’, $secret_iv), 0, 16);
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    function decrypt($string) {
        $output = false;
        $encrypt_method = “AES-256-CBC”;
        $secret_key = ‘fe67d68ee1e09b47acd8810b880d537034c10c15344433a992b9c79002666844’;
        $secret_iv = ‘fdd3345455fffgffffhkkyoife67d68ee1e09b47acd8810b880d537034c10c15344433a992b9c79002666844’;

        $key = hash("sha256", $secret_key);
        $iv = substr(hash("sha256", $secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }
    */
}
