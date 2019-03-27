<?php

namespace DropBundle\Controller;

use DropBundle\Entity\Ord;
use DropBundle\Entity\Product;
use DropBundle\Form\Type\OrderClientType;
use DropBundle\Services\GetNewPostAddressFromDB;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserActionController extends Controller
{
    /**
     * @Route("/new-order/{id}", name="user_action.new_order", defaults={"id": 0})
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function newOrderAction(Request $request, $id=0)
    {

//        if ($prd = $request->request->get("product")) {
//            return new Response();
//        }

        $addressDb = $this->get('get.new.post.address.from.db');
//        $addressDb->getWarehouses('Аджамка');

        $form = $this->createForm(OrderClientType::class);

        $form->handleRequest($request);

//        $d = $form->getData();


        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
//            var_dump($data);die;

            $clientName = $data["last_name"]." ".$data["name"]." ".$data["patronymic"];
            $sale = 0;
            $purchase = 0;

            $productsArray = [];

            $productsAr = $data["product_array"];
            $prdrArr = json_decode($productsAr);

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

            $order = new Ord();
            $products = $this->getDoctrine()->getRepository(Product::class)->findByMultipleId($productsId);
            foreach ($products as $product) {
                $order->addProducts($product);
            }

            $order->setClientName($clientName);
            $order->setClientPhone($data["phone"]);
            $order->setComment($data["comment"]);

            $order->setDeliveryAddress($data["full_address"]);
            $order->setStatus(Ord::NEW_ORDER);

            $order->setPurchaseAmount($purchase);
            $order->setSaleAmount($sale);
            $order->setIncome($income);
            $order->setUser($this->getUser());


            $em = $this->getDoctrine()->getManager();
            $em->persist($order);
            $em->flush();
            return $this->redirectToRoute("user_view.orders");
        }

//        $staticCitiesFull = $addressDb->getCities();

        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        return $this->render('@Drop/user-action/new_order.html.twig', [
//            'cities' => $staticCitiesFull,
            'form' => $form->createView(),
            'products' => $products,
            'id' => $id,
        ]);
    }
}

