<?php

namespace Droparea\DropBundle\Controller;

use Droparea\DropBundle\Form\Type\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PatronController extends Controller
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
            return $this->redirectToRoute('patron', [
                'success' => 1,
            ]);
        }

        $success = $request->get('success');

        return $this->render('@Drop/Patron/main-patron.html.twig', [
            'form' => $form->createView(),
            'success' => $success,
        ]);
    }
}
