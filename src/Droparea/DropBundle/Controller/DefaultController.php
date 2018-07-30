<?php

namespace Droparea\DropBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Drop/Default/index.html.twig');
    }
}
