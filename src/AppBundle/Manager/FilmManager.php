<?php
/**
 * Created by PhpStorm.
 * User: jennou
 * Date: 28/02/2018
 * Time: 11:27
 */

namespace AppBundle\Manager;

use AppBundle\Entity\Film;
use Doctrine\ORM\EntityManagerInterface;


class FilmManager
{
    private $em;

    /**
     * FilmManager constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getFilms()
    {
        return $this->em->getRepository(Film::class)
            ->findAll();
    }

    public function searchFilm($search) {
        return $this->em
            ->getRepository(Film::class)
            ->searchFilm($search);
    }

    /*public function searchActeur($search) {
        return $this->em
            ->getRepository(Film::class)
            ->searchActeur($search);
    }*/
}