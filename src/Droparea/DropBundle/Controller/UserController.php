<?php

namespace Droparea\DropBundle\Controller;

use Droparea\DropBundle\Entity\User;
use Droparea\DropBundle\Form\Type\RegisterUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

//        return new Response('Somthing wrong!');
    }

}
