<?php
/**
 * Created by PhpStorm.
 * User: jennou
 * Date: 02/03/2018
 * Time: 16:18
 */
namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Film;
use AppBundle\Form\FilmType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;

class FilmController extends Controller
{
    // Affiche la liste des films partie admin
    /**
     * @Route("/admin/films", name="admin_film_list")
     */
    public function listAction()
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $films = $em->getRepository(Film::class)
            ->findAll();
        return $this->render('admin/listFilm.html.twig', [
            'films' => $films,
            'user' => $user
        ]);
    }

    // Ajouter un film
    /**
     * @Route("/admin/films/add", name="film_add")
     */
    public function addAction(Request $request)
    {
        $user = $this->getUser();
        $films = new Film();

        $form = $this->createForm(FilmType::class, $films);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('admin_film_list');
        }

        return$this->render('admin/addFilm.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    //Modifier Film
    /**
     * @Route("/admin/films/{id}/edit", name="film_edit", requirements={"id"="\d+"})
     */
    public function EditAction($id, Request $request)
    {
        $user = $this->getUser();
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
            return $this->redirectToRoute('admin_film_list');
        }

        return $this->render('admin/editFilm.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    // Supprimer un film
    /**
     * @Route("/admin/films/{id}/delete", name="film_delete", requirements={"id"="\d+"})
     */
    public function DeleteAction(Film $film)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($film);
        $em->flush();

        return $this->redirectToRoute('admin_film_list');
    }

    // Uploader une image
    /**
     * @Route("/admin/films/{id}/image", name="film_image", requirements={"id"="\d+"})
     */
    public function ImageViewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository(Film::class)
            ->find($id);
        $file = $this->getParameter("files_directory")."/".$film->getImage();
        return new BinaryFileResponse($file);
    }

    // Uploader une video
    /**
     * @Route("/admin/films/{id}/video", name="film_video", requirements={"id"="\d+"})
     */
    public function VideoViewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository(Film::class)
            ->find($id);
        $file = $this->getParameter("files_directory")."/".$film->getVideo();
        return new BinaryFileResponse($file);
    }

    //Test Atelier Geoffrey
    public function menuAction()
    {
        $user = $this->getUser();
        $menus = ["Profil", "Liste des films", "Genre"];

        return $this->render('admin/menu.html.twig', [
            'menus' =>$menus,
            'user' => $user
        ]);
    }
}