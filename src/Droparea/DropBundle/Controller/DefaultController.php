<?php

namespace Droparea\DropBundle\Controller;

use Droparea\DropBundle\Entity\Category;
use Droparea\DropBundle\Entity\Product;
use Droparea\DropBundle\Form\Type\LoginType;
use Droparea\DropBundle\Form\Type\OrderClientType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Droparea\DropBundle\Form\Type\RegisterUserType;

/**
 * Class DefaultController
 * @package Droparea\DropBundle\Controller
 */
class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
//        if (!$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
//            throw $this->createAccessDeniedException('GET OUT!');
//        }
        $regForm = $this->createForm(RegisterUserType::class);
        $authForm = $this->createForm(LoginType::class);
        $authForm->handleRequest($request);
        $regForm->handleRequest($request);
        if ($regForm->isSubmitted() && $regForm->isValid()) {
            $data = $regForm->getData();
            $response = $this->forward('DropBundle:User:registerUser', [
                'data' => $data,
            ]);
            return $response;
        }
        if ($authForm->isSubmitted() && $authForm->isValid()) {
            $data = $authForm->getData();
            $response = $this->forward('DropBundle:User:authUser', [
                'data' => $data,
            ]);
            return $response;
        }
        return $this->render('@Drop/Default/index.html.twig', [
            'reg_form' => $regForm->createView(),
            'auth_form' => $authForm->createView(),
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

