<?php

namespace DropBundle\Controller;

use DropBundle\Entity\Category;
use DropBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserViewController extends Controller
{
    /**
     * @Route("/products", name="user_view.products")
     *
     * @param Request $request
     * @param int $category
     * @return Response
     */
    public function productListAction(Request $request, $category = 0)
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
        if ($category!=0) {
            $products = $this->getDoctrine()->getRepository(Product::class)->findBy([
                'category' => $category,
            ]);
            foreach ($categories as $item) {
                if ($item->getId() == $category) {
                    $currentLinkName = $item->getName();
                }
            }
        } else {
            $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
            $currentLinkName = 'all';
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );

        return $this->render('@Drop/Pages/products.html.twig', [
            'categories' => $categories,
            'current_link_name' => $currentLinkName,
            'pagination' => $pagination,
        ]);
    }
}

