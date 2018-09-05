<?php

namespace Droparea\DropBundle\Controller;

use Droparea\DropBundle\Entity\User;
use Droparea\DropBundle\Form\Type\RegisterUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function registerUserAction(Request $request)
    {
        $form = $this->createForm(RegisterUserType::class);
//        $user = new User();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Welcome '.$user->getEmail());

            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $this->get('app.security.login_form_authenticator'),
                    'main'
                );

//            return $this->redirectToRoute('drop_homepage');
        }
//        $user->setName($data['name']);
//        $user->setEmail($data['email']);
//        $user->setPhone($data['phone']);
//        $user->setPassword($data['password']);


        return $this->render('@Drop/User/register.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function authUser($data)
    {
        return $this->redirectToRoute('drop_homepage'); //Here must be route, where user is from !
    }

    public function showUserPageAction(Request $request)
    {
        if ($form = $request->request->get("send_data")) {
//            print_r($_REQUEST);
        }
//        print_r($_REQUEST);
        $user = $this->getUser();

        if ($user == null) {
            return $this->redirectToRoute("drop_homepage");
        }
        return $this->render('@Drop/Pages/user-page.html.twig', [
            'user' => $user,
        ]);
    }
}
