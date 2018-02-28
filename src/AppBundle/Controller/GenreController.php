<?php
/**
 * Created by PhpStorm.
 * User: jennou
 * Date: 26/02/2018
 * Time: 14:24
 */

namespace AppBundle\Controller;



use AppBundle\Entity\Genre;
use AppBundle\Form\GenreType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class GenreController extends Controller
{
    /**
     * @Route("/genres/{id}", name="genre_view", requirements={"id"="\d+"})
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $genre = $em->getRepository(Genre::class)
            ->find($id);

        return $this->render('genre/viewGenre.html.twig', [
            'genre' => $genre
        ]);
    }

    /**
     * @Route("/genres", name="genre_list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $genres = $em->getRepository(Genre::class)
            ->findAll();

        return $this->render('genre/listGenre.html.twig', [
            'genres' => $genres
        ]);
    }

    /**
     * @Route("/genres/add", name="genre_add")
     */
    public function addAction(Request $request)
    {
        $genre = new Genre();

        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $genre = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($genre);
            $em->flush();

            return $this->redirectToRoute('genre_list');
        }

        return $this->render('genre/addGenre.html.twig', [
            'form' => $form->createView()
        ]);
    }

}