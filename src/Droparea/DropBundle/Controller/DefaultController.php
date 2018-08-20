<?php

namespace Droparea\DropBundle\Controller;

use Droparea\DropBundle\Entity\Category;
use Droparea\DropBundle\Entity\Product;
use Droparea\DropBundle\Form\Type\OrderClientType;
use Droparea\DropBundle\Form\Type\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $form = $this->createForm(ProductType::class);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em->persist($data);
            $em->flush();
            return $this->redirectToRoute('drop_homepage', [
                'success' => 1,
            ]);
        }

        $success = $request->get('success');

        return $this->render('@Drop/Default/index.html.twig', [
            'form' => $form->createView(),
            'success' => $success,
        ]);
    }

    public function productsAction($category = 0)
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

        return $this->render('@Drop/Pages/products.html.twig', [
            'products' => $products,
            'categories' => $categories,
            'current_link_name' => $currentLinkName,
        ]);
    }

    public function oneProductAction($id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        return $this->render('@Drop/Pages/product-page.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * Process Ajax request to get list of warehouses
     */
    public function ajaxNewPostAction(Request $request)
    {
        if ($city = $request->request->get('destination')) {
            $addressDb = $this->get('get.new.post.address.from.db');
            $warehouses = $addressDb->getWarehouses($city);
            $area = $addressDb->getArea($city);
            $ar = [$city, $area, $warehouses]; //array that will be return to page
            $ar = json_encode($ar);
            return new Response($ar);
        }
        return new Response('none!E');
    }
    public function newOrdersAction(Request $request)
    {
        $addressDb = $this->get('get.new.post.address.from.db');
        $form = $this->createForm(OrderClientType::class);
        $staticSitiesFull = $addressDb->getCities();
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('@Drop/Pages/new-orders.html.twig', [
            'cities' => $staticSitiesFull,
            'form' => $form->createView(),
            'products' => $products,
        ]);
    }

    public function ordersAction()
    {
        return $this->render('@Drop/Pages/orders.html.twig');
    }

    public function paymentsAction()
    {
        //$products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('@Drop/Default/practice.html.twig');
    }

    public function statisticAction()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('@Drop/Pages/products.html.twig', [
            'products' => $products,
        ]);
    }

    public function referralsAction()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('@Drop/Pages/products.html.twig', [
            'products' => $products,
        ]);
    }

    public function newsAction()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('@Drop/Pages/products.html.twig', [
            'products' => $products,
        ]);
    }
}

