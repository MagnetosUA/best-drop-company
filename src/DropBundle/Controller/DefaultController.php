<?php

namespace DropBundle\Controller;

use DropBundle\Entity\Category;
use DropBundle\Entity\Ord;
use DropBundle\Entity\Product;
use DropBundle\Form\Type\OrderClientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package Droparea\DropBundle\Controller
 */
class DefaultController extends Controller
{


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

    public function newOrdersAction(Request $request, $id)
    {
        if ($prd = $request->request->get("product")) {
            return new Response();
        }

        $addressDb = $this->get('get.new.post.address.from.db');
        $form = $this->createForm(OrderClientType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
//            var_dump($this->getUser());die;
            $data = $form->getData();
            $clientName = $data["last_name"]." ".$data["name"]." ".$data["patronymic"];
            $income = 0;
            $sale = 0;
            $purchase = 0;

            $productsArray = [];

            $productsAr = $data["product_array"];
//            var_dump($productsAr);
            $prdrArr = json_decode($productsAr);
//            var_dump($prdrArr);die;
            $productsId = [];
            foreach ($prdrArr as $product) {
                if ($product == null) {
                    continue;
                }
                $productsArray[$product->id]["count"] = [$product->count];
                $productsArray[$product->id]["cost"] = [$product->cost];
                $productsArray[$product->id]["name"] = [$product->name];

                $sale += ($product->cost * $product->count);
                $purchase += ($product->myCost * $product->count);

                $productsId[] = $product->id;
            }
            $income = $purchase - $sale;
//            $this->E($product->id);die;
            $order = new Ord();
            $products = $this->getDoctrine()->getRepository(Product::class)->findByMultipleId($productsId);
            foreach ($products as $product) {
                $order->addProducts($product);
            }
//            var_dump($product);die;
//            echo gettype($product);die;

//            var_dump($product->getName());die;
//            $order->addProducts($product);
            $order->setClientName($clientName);
            $order->setClientPhone($data["phone"]);
            $order->setComment($data["comment"]);
//            $order->setCreatedDate();
            $order->setDeliveryAddress($data["full_address"]);
            $order->setStatus(Ord::NEW_OREDER);
//            $order->setOrderNumber(1);
//            $order->setIncome();
            $order->setPurchaseAmount($purchase);
            $order->setSaleAmount($sale);
            $order->setIncome($income);
            $order->setUser($this->getUser());


            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();
            return $this->redirectToRoute("orders");


//            $request->request->get("product-name");
//            echo $request->request->get("product-name");die;
//            echo "<pre>";
//            print_r($_REQUEST);
//            echo "</pre>";
//            die;
//            var_dump($data);die;
//            echo $data["product-name"];die;

        }

        $staticSitiesFull = $addressDb->getCities();
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('@Drop/Pages/new-orders.html.twig', [
            'cities' => $staticSitiesFull,
            'form' => $form->createView(),
            'products' => $products,
            'id' => $id,
        ]);
    }

    public function ordersAction()
    {
        $user = $this->getUser();
//        echo $user->getId();die;
        $orders = $this->getDoctrine()->getRepository(Ord::class)->findBy(["user" => $this->getUser()]);//findOneBy(["user" => $user->getId()]);

        $statusCount["new"] = 0;
        $statusCount["in_processing"] = 0;
        $statusCount["confirmed"] = 0;
        $statusCount["rejected"] = 0;
        $statusCount["shipped"] = 0;
        $statusCount["non_purchase"] = 0;
        $statusCount["ransom"] = 0;
        $statusCount["not_sent_fo_processing"] = 0;

        foreach ($orders as $order) {
            if ($order->getStatus() == Ord::NEW_ORDER) {$statusCount["new"] += 1;}
            if ($order->getStatus() == Ord::IN_PROCESSING) {$statusCount["in_processing"] += 1;}
            if ($order->getStatus() == Ord::CONFIRMED) {$statusCount["confirmed"] += 1;}
            if ($order->getStatus() == Ord::REJECTED) {$statusCount["rejected"] += 1;}
            if ($order->getStatus() == Ord::SHIPPED) {$statusCount["shipped"] += 1;}
            if ($order->getStatus() == Ord::NON_PURCHASE) {$statusCount["non_purchase"] += 1;}
            if ($order->getStatus() == Ord::RANSOM) {$statusCount["ransom"] += 1;}
            if ($order->getStatus() == Ord::NOT_SENT_FOR_PROCESSING) {$statusCount["not_sent_fo_processing"] += 1;}
        }

//        foreach ($orders as $order) {
//            echo 1;
//        }

        return $this->render('@Drop/Pages/orders.html.twig', [
            'orders' => $orders,
            'status_count' => $statusCount,
        ]);
    }



//    additional functional for testing
    private function E($var) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }

    public function catalogueAction()
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render('@Drop/Pages/catalogue.html.twig', [
            'products' => $products,
        ]);
    }
}

