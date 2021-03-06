<?php

namespace AppBundle\Repository;

/**
 * FilmRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FilmRepository extends \Doctrine\ORM\EntityRepository
{
    public function searchFilm($search) {
        // requete recherche par titre
        $qb = $this->createQueryBuilder("f")
            ->where('f.titre like :search')
            ->setParameter('search', '%' . $search . '%');

        return $qb
            ->getQuery()
            ->getResult();
    }

    //public function searchActeur($search) {
        // requete recherche par acteur
        //$qb = $this->createQueryBuilder("f")
            //->where('f.acteur like :search')
            //->setParameter('search', '%' . $search . '%');

        // return $qb
            // ->getQuery()
            // ->getResult();
    //}
}
