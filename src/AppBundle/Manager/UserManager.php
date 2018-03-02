<?php

namespace AppBundle\Manager;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager
{
    private $passwordEncoder;
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $entityManager;
    }

    public function getUsers()
    {
        return $this->em->getRepository(User::class)
            ->findAll();
    }

    public function createUser($nom, $prenom, $age, $email, $pseudo, $password, $is_admin)
    {
        $user = new User();
        $password = $this->passwordEncoder->encodePassword($user, $password);
        $user
            ->setNom($nom)
            ->setPrenom($prenom)
            ->setAge($age)
            ->setEmail($email)
            ->setPseudo($pseudo)
            ->setPassword($password)
            ->setIsAdmin($is_admin);
        $this->em->persist($user);
        $this->em->flush();
    }
}