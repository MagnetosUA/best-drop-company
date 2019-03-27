<?php

namespace DropBundle\Controller;

use DropBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
     */
    public function productListAction(Request $request)
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAllProductsQuery();

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
}

