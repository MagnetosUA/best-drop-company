<?php

namespace DropBundle\Controller;

use DropBundle\Form\Type\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        $form = $this->createForm(LoginType::class, [
            '_username' => $lastUsername,
        ]);
        return $this->render('@Drop/Sequrity/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);
    }

    public function logoutAction()
    {
        throw new \Exception('this should not be reached!');
    }
}
