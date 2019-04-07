<?php

namespace DropBundle\Controller;

use DropBundle\Entity\News;
use DropBundle\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    /**
     * @param News $entity
     */
    protected function persistEntity($entity)
    {
        $this->em->persist($entity);
        $this->em->getRepository(User::class)->addLatestNewsToAllUsers($entity);
        return;
    }
}

