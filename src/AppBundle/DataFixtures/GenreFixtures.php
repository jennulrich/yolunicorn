<?php
/**
 * Created by PhpStorm.
 * User: jennou
 * Date: 26/02/2018
 * Time: 14:23
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class GenreFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Tableau qui contient les infos qui vont etre envoyées en bdd
        $genres = [
            "Action", "Animation", "Aventure", "Comédie", "Comédie Dramatique", "Documentaire",
            "Drame", "Epouvante-Horreur", "Policier", "Science-Fiction", "Thriller"
        ];

        // Ajout des genres ($genre[]) dans la table "genre" de la base de données
        foreach ($genres as $genre) {
            $genreInfo = new Genre();
            $genreInfo
                ->setGenreCat($genre);

            $manager->persist($genreInfo);
        }
        $manager->flush();
    }
}