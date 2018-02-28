<?php
/**
 * Created by PhpStorm.
 * User: amandine
 * Date: 23/02/2018
 * Time: 11:12
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Manager\UserManager;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{
    /**
     * @Route("/user/{id}", name="user_view", requirements={"id"="\d+"})
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)
            ->find($id);
        return $this->render('user/viewUser.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/user", name="user_list")
     */
    public function listAction(UserManager $userManager)
    {
        $users = $userManager->getUsers();

        //$em = $this->getDoctrine()->getManager();
        //$users = $em->getRepository(User::class)->findAll();

        return $this->render('user/listUser.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/user/{id}/edit", name="user_edit", requirements={"id"="\d+"})
     */
    public function EditAction($id, Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)
            ->find($id);
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('user_view', [
                "id"=>$user->getId(),
            ]);
        }

        return $this->render('user/editUser.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function addActionInscription(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('age', NumberType::class)
            ->add('email', TextType::class)
            ->add('pseudo', TextType::class)
            ->add('password', PasswordType::class)
            ->add('save', SubmitType:: class, ['label' => 'Inscription'])
            ->getForm();

        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $user = $form->getData();
                $em = $this->getDoctrine()->getManager();

                $password = $passwordEncoder->encodePassword($user, $user->getPassword());
                $user->setPassword($password);

                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('film_list');
            }

        return $this->render('user/addUser.html.twig', [
            'form' => $form->createView()
        ]);

    }

    //Test Atelier Geoffrey
    public function menuAction()
    {
        $menus = ["menu 1", "menu 2", "menu 3"];

        return $this->render('menu.html.twig', [
            'menus' =>$menus
        ]);
    }
}