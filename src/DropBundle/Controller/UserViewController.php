<?php

namespace DropBundle\Controller;

use DropBundle\Entity\Category;
use DropBundle\Entity\Ord;
use DropBundle\Entity\Product;
use DropBundle\Services\StatusCountProcessor;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class UserViewController
 * @package DropBundle\Controller
 * @Security("is_granted('ROLE_USER')")
 */
class UserViewController extends Controller
{
    /**
     * @Route("/products", name="user_view.products")
     * @return Response
     */
    public function productListAction()
    {
        return $this->forward('DropBundle:Guest:productList');
    }

    /**
     * @Route("/category/{slug}", name="user_view.product_list_by_category")
     * @param Category $category
     * @return Response
     */
    public function productListByCategoryAction(Category $category)
    {
        $products = $this->getDoctrine()->getRepository(Product::class)->findAllProductsByCategoryQuery($category);

        return $this->forward('DropBundle:Guest:productList', [
            'products' => $products,
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
     * @param StatusCountProcessor $countProcessor
     * @return Response
     */
    public function ordersAction(StatusCountProcessor $countProcessor)
    {
        $currentUser = $this->getUser();
        $orders = $this->getDoctrine()->getRepository(Ord::class)->findBy(["user" => $currentUser]);

        $statusCount = $countProcessor->getStatusesCount($currentUser->getId());

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

    /**
     * @Route("/personal-data", name="user_view.personal_data")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function personalDataAction()
    {
        $user = $this->getUser();
        return $this->render('@Drop/user-view/personal_data.html.twig', [
            'user' => $user,
        ]);
    }
}

