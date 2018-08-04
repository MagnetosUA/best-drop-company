<?php

namespace Droparea\DropBundle\Controller;

use Droparea\DropBundle\Form\Type\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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

        return $this->render('@Drop/Default/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
