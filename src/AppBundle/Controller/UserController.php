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
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)
            ->findAll();
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
}