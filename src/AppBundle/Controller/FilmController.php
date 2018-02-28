<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Film;
use AppBundle\Form\FilmType;
use AppBundle\Manager\FilmManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;


class FilmController extends Controller
{
    /**
     * @Route("/films/{id}", name="film_view", requirements={"id"="\d+"})
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository(Film::class)
            ->find($id);
        return $this->render('film/viewFilm.html.twig', [
            'film' =>$film
        ]);
    }

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

    /**
     * @Route("/films/add", name="film_add")
     */
    public function addAction(Request $request)
    {
        $films = new Film();

        $form = $this->createForm(FilmType::class, $films);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('film_list');
        }

        return$this->render('film/addFilm.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //Modifier Film
    /**
     * @Route("/films/{id}/edit", name="film_edit", requirements={"id"="\d+"})
     */
    public function EditAction($id, Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $addFilm = $em->getRepository(Film:: class)
            ->find($id);
        $addFilm->setImage(null);
        $addFilm->setVideo(null);
        $form = $this->createForm(FilmType::class, $addFilm);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('film_list');
        }

        return $this->render('film/editFilm.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/films/{id}/image", name="film_image", requirements={"id"="\d+"})
     */
    public function ImageViewAction($id) {
        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository(Film::class)
            ->find($id);
        $file = $this->getParameter("files_directory")."/".$film->getImage();
        return new BinaryFileResponse($file);
    }

    /**
     * @Route("/films/{id}/video", name="film_video", requirements={"id"="\d+"})
     */
    public function VideoViewAction($id) {
        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository(Film::class)
            ->find($id);
        $file = $this->getParameter("files_directory")."/".$film->getVideo();
        return new BinaryFileResponse($file);
    }


    // Recherche
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
}