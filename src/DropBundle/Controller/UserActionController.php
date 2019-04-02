<?php

namespace DropBundle\Controller;

use DropBundle\Entity\Ord;
use DropBundle\Entity\Product;
use DropBundle\Form\Type\OrderClientType;
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
        $form = $this->createForm(OrderClientType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

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

        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        return $this->render('@Drop/user-action/new_order.html.twig', [
            'form' => $form->createView(),
            'products' => $products,
            'id' => $id,
        ]);
    }

    /**
     * @Route("/change-personal-data", name="user_action.change_personal_data")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function changePersonalData(Request $request)
    {
        $user = $this->getUser();

        if ($request->request->get("send_data")) {
            $data = $request->request->all();
            if ($data["name"]) {
                $user->setName($data["name"]);
            }
            if ($data["phone"]) {
                $user->setPhone($data["phone"]);
            }
            if ($data["cardname"]) {
                $user->setCardsOwnerName($data["cardname"]);
            }
            if ($data["cardnumber"]) {
                $user->setCardsNumber($data["cardnumber"]);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute("user_view.personal_data");
        }
    }
}

