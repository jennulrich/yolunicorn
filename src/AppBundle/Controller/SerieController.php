<?php
/**
 * Created by PhpStorm.
 * User: jennou
 * Date: 25/02/2018
 * Time: 11:18
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Serie;
use AppBundle\Form\SerieType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SerieController extends Controller
{
    // Voir le détail d'une série
    /**
     * @Route("/series/{id}", name="serie_view", requirements={"id"="\d+"})
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $serie = $em->getRepository(Serie::class)
            ->find($id);
        return $this->render('serie/viewSerie.html.twig', [
            'serie' =>$serie
        ]);
    }

    // Lister les séries
    /**
     * @Route("/series", name="serie_list")
     */
    public function listAction() {
        $em = $this->getDoctrine()->getManager();
        $series = $em->getRepository(Serie::class)
            ->findAll();
        return $this->render('serie/listSerie.html.twig', [
            'series' => $series
        ]);
    }

    // Ajouter une série
    /**
     * @Route("/series/add", name="serie_add")
     */
    public function addAction(Request $request)
    {
        $series = new Serie();

        $form = $this->createForm(SerieType::class, $series);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('serie_list');
        }

        return$this->render('serie/addSerie.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Modifier une série
    /**
     * @Route("/series/{id}/edit", name="serie_edit", requirements={"id"="\d+"})
     */
    public function EditAction($id, Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $addFilm = $em->getRepository(Serie::class)
            ->find($id);
        $form = $this->createForm(SerieType::class, $addFilm);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('serie_list');
        }

        return $this->render('serie/editSerie.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
