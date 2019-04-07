<?php

namespace DropBundle\Controller;

use DropBundle\Entity\Product;
use DropBundle\Entity\User;
use DropBundle\Form\Type\RegistrationUserType;
use DropBundle\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GuestController for process actions which is accessed for anonymous user
 *
 * @package DropBundle\Controller
 */
class GuestController extends Controller
{

    /**
     * @Route("/", name="guest.home")
     */
    public function homeAction()
    {
        $bestsellers = $this->getDoctrine()->getRepository(Product::class)->findBy(["top" => "1"]);
        return $this->render('@Drop/guest/home_page.html.twig', [
            'products' => $bestsellers,
        ]);
    }

    /**
     * @Route("/product-list", name="guest.product_list")
     * @param Request $request
     * @param null $products
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function productListAction(Request $request, $products = null)
    {
        if ($products == null) {
            $products = $this->getDoctrine()->getRepository(Product::class)->findAllProductsQuery();
        }

        $paginator  = $this->get('knp_paginator');

        $paginationProducts = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            16/*limit per page*/
        );

        return $this->render('@Drop/guest/product_list.html.twig', [
            'products' => $paginationProducts,
        ]);
    }

    /**
     * @Route("/registration-user", name="guest.registration_user")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response|null
     */
    public function registrationUserAction(Request $request, LoginFormAuthenticator $authenticator)
    {
        $referrer = null;
        if ($hash = $this->get('session')->get('ref_link_hash')) {
            $referrer = $this->getDoctrine()->getRepository(User::class)->findOneBy(['refLink' => $hash]);
        }

        $form = $this->createForm(RegistrationUserType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $form->getData();
            $user->setReferrer($referrer);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Welcome '.$user->getEmail());

            return $this->get('security.authentication.guard_handler')
                ->authenticateUserAndHandleSuccess(
                    $user,
                    $request,
                    $authenticator,
                    'main'
                );
        }
        return $this->render('@Drop/guest/registration_user.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/ref-link/{hash}", name="guest.registration_user_by_ref")
     * @param $hash
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function registrationUserByRefLink($hash)
    {
        $this->get('session')->set('ref_link_hash', $hash);
        return $this->redirectToRoute("guest.registration_user");
    }
}

