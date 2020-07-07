<?php


namespace App\Controller;

use App\Form\Type\SearchbarType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/searchBar", name="app_searchbar")
     */
    public function searchBar()
    {
        $form = $this->createForm(SearchbarType::class);

        return $this->render('search/searchBar.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @Route("/search", name="app_search")
     */
    public function search(Request $request, ArticleRepository $articleRepository)
    {
        $query = $request->request->get('searchbar')['query'];

        $articles = $articleRepository->findArticlesByTitle($query);

        return $this->render('search/search.html.twig', array(
            'articles' => $articles
        ));
    }
}