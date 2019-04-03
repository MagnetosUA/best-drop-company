<?php

namespace DropBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use DropBundle\Entity\Payment;
use DropBundle\Entity\User;

class PaymentManager
{
    public function process(User $user, $money, EntityManagerInterface $em)
    {
        if (!is_numeric($money) || ($money <= 0)) {
            $result['type'] = 'warning';
            $result['message'] = 'Недопустимое значение !';
            return $result;
        }
        if (($balance = $user->getBalance()) >= $money) {
            $balance = (integer)$balance - (integer)$money;
            $user->setBalance($balance);
            $payment = new Payment($money);
            $em->persist($payment);
            $em->persist($user);
            $em->flush();
            $result['type'] = 'success';
            $result['message'] = 'Заказ выплаты отправлен на обработку !';
            return $result;
        } else {
            $result['type'] = 'warning';
            $result['message'] = 'Недостаточно денег для вывода !';
            return $result;
        }
    }
}

