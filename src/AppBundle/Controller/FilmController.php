<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Film;
use AppBundle\Entity\User;
use AppBundle\Form\FilmType;
use AppBundle\Manager\FilmManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;


class FilmController extends Controller
{
    // Affiche le détail d'un film à l'user
    /**
     * @Route("/films/{id}", name="film_view", requirements={"id"="\d+"})
     */
    public function viewAction($id)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository(Film::class)
            ->find($id);
        return $this->render('film/viewFilm.html.twig', [
            'film' =>$film,
            'user' =>$user
        ]);
    }

    // Affiche la liste des films à l'user
    /**
     * @Route("/films", name="film_list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $films = $em->getRepository(Film::class)
            ->findAll();
        return $this->render('film/listFilm.html.twig', [
            'films' => $films
        ]);
    }

    // Recherche par titre de film
    /**
     * @Route("/films/search", name="film_search")
     */
    public function SearchAction(FilmManager $filmManager, Request $request) {
        $form = $this->createFormBuilder()
            ->add('search', SearchType::class)
            ->add('submit', SubmitType::class)
            ->getForm();
        $films = [];
        //$acteurs = [];

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $films = $filmManager->searchFilm($search);
            //$acteurs = $filmManager->searchActeur($search);
        }

        return $this->render('film/searchFilm.html.twig', [
            'films' => $films,
            //'acteurs'=> $acteurs,
            'form' => $form->createView()
        ]);
    }

    //Ajouter a ma liste de regarder plus tard
    /**
     * @Route("/films/{id}/favoris", name="ajout_list", requirements={"id"="\d+"})
     */
    public function FavorisAction(EntityManagerInterface $entityManager, $id)
    {
        /** @var Film $film */
        $film = $entityManager->getRepository(Film::class)
            ->find($id);
        /** @var User $user */
        $user = $this->getUser();
        $user->addFilm($film);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->redirectToRoute('film_list');
    }
}