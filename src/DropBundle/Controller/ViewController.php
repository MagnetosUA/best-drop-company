<?php

namespace Droparea\DropBundle\Controller;

use Droparea\DropBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ViewController extends Controller
{
    public function homeAction(Request $request)
    {
        $bestProducts = $this->getDoctrine()->getRepository(Product::class)->findBy(["top" => "1"]);
        return $this->render('@Drop/view/home.html.twig', [
            'products' => $bestProducts,
        ]);
    }
}

