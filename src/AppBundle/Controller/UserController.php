<?php
/**
 * Created by PhpStorm.
 * User: amandine
 * Date: 23/02/2018
 * Time: 11:12
 */

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Manager\UserManager;

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
     * @Route("/user/add", name="user_add")
     */
    public function addAction()
    {

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