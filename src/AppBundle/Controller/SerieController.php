<?php
/**
 * Created by PhpStorm.
 * User: jennou
 * Date: 25/02/2018
 * Time: 11:18
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Serie;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SerieController extends Controller
{
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
}