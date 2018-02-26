<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Film;
use AppBundle\Form\FilmType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class FilmController extends Controller
{
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
     * @Route("/film/{id}/edit", name="film_edit", requirements={"id"="\d+"})
     */
    public function EditAction($id, Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $addFilm = $em->getRepository(Film:: class)
            ->find($id);
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
}