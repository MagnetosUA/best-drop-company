<?php

namespace Droparea\DropBundle\Controller;

use Droparea\DropBundle\Entity\Product;
use Droparea\DropBundle\Form\Type\ProductType;
use Droparea\DropBundle\Form\Type\RegisterUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function registerUserAction(Request $request)
    {
        $userForm = $this->createForm(RegisterUserType::class);
        return $this->render('@Drop/Pages/register-user.html.twig', [
            'user_form' => $userForm->createView(),
        ]);
    }

}
