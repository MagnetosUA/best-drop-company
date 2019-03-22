<?php

namespace DropBundle\Controller;

use DropBundle\Entity\Category;
use DropBundle\Entity\Ord;
use DropBundle\Entity\Product;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserViewController extends Controller
{
    /**
     * @Route("/products", name="user_view.products")
     * @param Request $request
     * @return Response
     */
    public function productListAction(Request $request)
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAll();

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );

        return $this->render('@Drop/Pages/products.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/category/{slug}", name="user_view.product_list_by_category")
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function productListByCategoryAction(Request $request, Category $category)
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findBy([
            'category' => $category,
        ]);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );

        return $this->render('@Drop/Pages/products.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/product/{id}", name="user_view.one_product")
     *
     * @param $id
     * @return Response
     */
    public function oneProductAction($id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        return $this->render('@Drop/user-view/product_page.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/orders", name="user_view.orders")
     *
     * @return Response
     */
    public function ordersAction()
    {
        $orders = $this->getDoctrine()->getRepository(Ord::class)->findBy(["user" => $this->getUser()]);

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
//            if ($order->getStatus() == Ord::RANSOM) {$statusCount["ransom"] += 1;}
//            if ($order->getStatus() == Ord::NOT_SENT_FOR_PROCESSING) {$statusCount["not_sent_fo_processing"] += 1;}
        }

        return $this->render('@Drop/user-view/orders.html.twig', [
            'orders' => $orders,
            'status_count' => $statusCount,
        ]);
    }

    /**
     * @Route("/payments", name="user_view.payments")
     *
     * @return Response
     */
    public function paymentsAction()
    {
        return $this->render('@Drop/user-view/payments.html.twig');
    }

    /**
     * @Route("/statistic", name="user_view.statistic")
     *
     * @return Response
     */
    public function statisticAction()
    {
        return $this->render('@Drop/user-view/statistic.html.twig');
    }

    /**
     * @Route("/referrals", name="user_view.referrals")
     *
     * @return Response
     */
    public function referralsAction()
    {
        return $this->render('@Drop/user-view/referrals.html.twig');
    }

    /**
     * @Route("/news", name="user_view.news")
     *
     * @return Response
     */
    public function newsAction()
    {
        return $this->render('@Drop/user-view/news.html.twig');
    }
}

