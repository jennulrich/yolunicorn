<?php

namespace AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            // TODO: Implement load() method.
            $user = new User();
            $user
                ->setNom('Nom user ' .$i)
                ->setPrenom('Prenom user ' .$i)
                ->setAge(mt_rand(18, 75))
                ->setEmail('user@test.fr')
                ->setPseudo('pseudo ' .$i)
                ->setPassword('password');

            $manager->persist($user);
        }

        $manager->flush();
    }
}