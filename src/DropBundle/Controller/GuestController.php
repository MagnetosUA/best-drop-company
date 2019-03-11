<?php

namespace DropBundle\Controller;

use DropBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class GuestController extends Controller
{

    /**
     * @Route("/", name="guest.home")
     */
    public function homeAction()
    {
        $bestsellers = $this->getDoctrine()->getRepository(Product::class)->findBy(["top" => "1"]);
        return $this->render('@Drop/guest/home.html.twig', [
            'products' => $bestsellers,
        ]);
    }

    /**
     * @Route("/product-list", name="guest.product_list")
     */
    public function productListAction()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('@Drop/guest/product_list.html.twig', [
            'products' => $products,
        ]);
    }
}

