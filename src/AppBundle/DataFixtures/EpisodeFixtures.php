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
use Doctrine\Common\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i<=15; $i++) {
            $episode = new Episode();
            $episode
                ->setNbEpisode($i);
            $manager->persist($episode);
        }
        $manager->flush();
    }
}