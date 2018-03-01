<?php
/**
 * Created by PhpStorm.
 * User: jennou
 * Date: 25/02/2018
 * Time: 14:40
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Saison;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SaisonFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Ajout des données (nombre de saisons, 10 saisons max)
        for ($i=1; $i<=6; $i++) {
           $serie = $this->getReference("serie-".$i);
           for ($j=1; $j<=10; $j++) {
               $saison = new Saison();
               $saison->setSerie($serie);
               $saison->setName('Saison ' . $j);

               $manager->persist($saison);
               $this->setReference("saison-".$i."-".$j, $saison);
           }
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            SerieFixtures::class,
        );
    }
}