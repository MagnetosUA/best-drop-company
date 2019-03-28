<?php

namespace DropBundle\Controller;

use DropBundle\Services\NewPostAddressManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends Controller
{
    /**
     * @Route("/ajax-new-post", name="ajax.new_post")
     * @param Request $request
     * @param NewPostAddressManager $addressManager
     * @return Response
     * Process Ajax request to get list of warehouses
     */
    public function newPostAction(Request $request, NewPostAddressManager $addressManager)
    {
        if ($city = $request->request->get('destination')) {
            $warehouses = $addressManager->getWarehouses($city);
            $area = $addressManager->getArea($city);
            $ar = [$city, $area, $warehouses]; //array that will be return to page
            $ar = json_encode($ar);
            return new Response($ar);
        }
        return new Response('not found!');
    }
}

