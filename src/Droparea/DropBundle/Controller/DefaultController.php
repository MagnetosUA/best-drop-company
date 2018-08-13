<?php

namespace Droparea\DropBundle\Controller;

use Droparea\DropBundle\Entity\Category;
use Droparea\DropBundle\Entity\Product;
use Droparea\DropBundle\Form\Type\OrderClientType;
use Droparea\DropBundle\Form\Type\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use NovaPoshta\Config;
use NovaPoshta\ApiModels\Address;
use NovaPoshta\MethodParameters\Address_getStreet;
use NovaPoshta\MethodParameters\Address_getWarehouses;
use NovaPoshta\MethodParameters\Address_getCities;
use NovaPoshta\MethodParameters\Address_getAreas;

Config::setApiKey('bbd31a0c4e0801075b2253a36e0403ad');
Config::setFormat(Config::FORMAT_JSONRPC2);
Config::setLanguage(Config::LANGUAGE_UA);

class DefaultController extends Controller
{
    public function getCities()
    {
        $data = new Address_getCities();
//        $data->setRef('db5c896a-391c-11dd-90d9-001a92567626');
        $data->setPage(1);
//        $data->setFindByString('Пол');
        return Address::getCities($data);
    }

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

    public function ordersAction(Request $request)
    {


        $form = $this->createForm(OrderClientType::class);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        return $this->render('@Drop/Pages/orders.html.twig', [
            'form' => $form->createView(),
        ]);
//        $c = $this->getCities();
//        var_dump($c);die;
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

