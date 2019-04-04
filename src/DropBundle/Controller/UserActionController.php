<?php

namespace DropBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use DropBundle\Entity\Ord;
use DropBundle\Entity\Product;
use DropBundle\Entity\User;
use DropBundle\Form\Type\OrderClientType;
use DropBundle\Services\PaymentManager;
use DropBundle\Services\RefLinkGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class UserActionController for POST actions which can do registered user with ROLE_USER role
 *
 * @package DropBundle\Controller
 * @Security("is_granted('ROLE_USER')")
 */
class UserActionController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

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

            $this->em->persist($order);
            $this->em->flush();
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
            $this->em->persist($user);
            $this->em->flush();
        }
        return $this->redirectToRoute("user_view.personal_data");
    }

    /**
     * @Route("/order-payment", name="user_action.order_payment")
     * @param Request $request
     * @param PaymentManager $paymentManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function orderPaymentAction(Request $request, PaymentManager $paymentManager)
    {
        /** @var User $user */
        $user = $this->getUser();

        if ($money = $request->request->get('payment-money')) {
            $result = $paymentManager->process($user, $money, $this->em);
            $this->addFlash($result['type'], $result['message']);
        }
        return $this->redirectToRoute("user_view.payments");
    }

    /**
     * @Route("/generate-ref-link", name="user_action.generate_referral_link")
     * @param RefLinkGenerator $generator
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function generateReferralLinkAction(RefLinkGenerator $generator)
    {
        $user = $this->getUser();
        $link = $generator->generateLink($user, $this->em);
        if (is_string($link)) {
            $this->addFlash('success', 'Реферальная ссылка сгенерированна !');
        }
        return $this->redirectToRoute('user_view.personal_data');
    }
}

