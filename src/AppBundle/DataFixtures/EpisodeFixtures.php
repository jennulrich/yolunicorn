<?php
/**
 * Created by PhpStorm.
 * User: jennou
 * Date: 26/02/2018
 * Time: 11:04
 */

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($k = 1; $k <= 6; $k++){
            for ($i = 1; $i <= 10; $i++) {
                $saison = $this->getReference("saison-".$k."-".$i);
                for ($j = 1; $j <= 15; $j++) {
                    $episode = new Episode();
                    $episode
                        ->setSaison($saison)
                        ->setName('Episode ' . $j);
                    $manager->persist($episode);
                }

            }
        }
        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    function getDependencies()
    {
        return array(
            SaisonFixtures::class,
        );
    }
}