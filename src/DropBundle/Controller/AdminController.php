<?php

namespace DropBundle\Controller;

use DropBundle\Entity\News;
use DropBundle\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{

    /**
     * @param News $entity
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function prePersistEntity($entity)
    {
        $user = $this->em->getRepository(User::class)->find(22);
        $user->addLatestNews($entity);
        $this->em->persist($user);
        $this->em->flush();
        return;
    }
}
