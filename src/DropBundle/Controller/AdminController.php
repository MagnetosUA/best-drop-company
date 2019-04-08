<?php

namespace DropBundle\Controller;

use DropBundle\Entity\News;
use DropBundle\Entity\PostAddress;
use DropBundle\Entity\Product;
use DropBundle\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    /**
     * @param object $entity
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function persistEntity($entity)
    {
        if ($entity instanceof News) {
            $this->em->persist($entity);
            $this->em->getRepository(User::class)->addLatestNewsToAllUsers($entity);
            return;
        }

        if ($entity instanceof Product) {
            $imageNames = [];
            $images = $entity->getImages();
            foreach ($images as $image) {
                $uniqName = md5(uniqid());
                $imageName = $uniqName.'.'.$image->guessExtension();
                $image->move(
                    $this->getParameter('images_directory'),
                    $imageName
                );
                $imageNames[] = $imageName;
            }

            $entity->setImages($imageNames);
            $this->em->persist($entity);
            $this->em->flush();
        }
        return parent::persistEntity($entity);
    }

    protected function newAction()
    {
        $entity = $this->executeDynamicMethod('createNew<EntityName>Entity');
        if ($entity instanceof PostAddress) {
            $addressProvider = $this->get('DropBundle\Services\NewPostAddressProvider');
            $addressProvider->updateAll();
            return $this->redirectToReferrer();
        }

        return parent::newAction();
    }
}

