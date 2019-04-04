<?php

namespace DropBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use DropBundle\Entity\User;

class RefLinkGenerator
{
    public function generateLink(User $user, $host, EntityManagerInterface $em)
    {
        $link = $host.'/ref-link/'.md5($user->getEmail());
        $user->setRefLink($link);
        $em->persist($user);
        $em->flush();
        return $link;
    }
}

