<?php

namespace Droparea\DropBundle\Controller;

use Droparea\DropBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function registerUserAction($data)
    {
        $user = new User();
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPhone($data['phone']);
        $user->setPassword($data['password']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('drop_homepage');
    }

    public function authUser($data)
    {
        return $this->redirectToRoute('drop_homepage'); //Here must be route, where user is from !
    }
}
