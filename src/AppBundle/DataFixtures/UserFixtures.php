<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Film;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class UserFixtures
 * @package AppBundle\DataFixtures
 */
class UserFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            // TODO: Implement load() method.
            $user = new User();

            /** @var Film $film1 */
            $film1 = $this->getReference("film-1");

            /** @var Film $film2 */
            $film2 = $this->getReference("film-2");

            /** @var Film $film3 */
            $film3 = $this->getReference("film-3");

            $user
                ->setNom('Nom user ' .$i)
                ->setPrenom('Prenom user ' .$i)
                ->setAge(mt_rand(18, 75))
                ->setEmail('user'.$i.'@test.fr')
                ->setPseudo('pseudo ' .$i)
                ->addFilm($film1)
                ->addFilm($film2)
                ->addFilm($film3)
                // password : bcrypt('password')
                ->setPassword( '$2y$10$LlPMShQH0oM1pYY1UvRCDuVI8Rin8bMhHoSgXinF48dqSsKdJ5LAa');

            $manager->persist($user);
        }

        $manager->flush();
    }
}