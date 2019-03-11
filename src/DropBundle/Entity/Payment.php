<?php

namespace DropBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Table(name="payment")
 * @ORM\Entity(repositoryClass="DropBundle\Repository\PaymentRepository")
 */
class Payment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="�amount", type="string", length=255)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="refAmount", type="string", length=255)
     */
    private $refAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="created", type="string", length=255)
     */
    private $created;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set �amount
     *
     * @param string $�amount
     *
     * @return Payment
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get �amount
     *
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set refAmount
     *
     * @param string $refAmount
     *
     * @return Payment
     */
    public function setRefAmount($refAmount)
    {
        $this->refAmount = $refAmount;

        return $this;
    }

    /**
     * Get refAmount
     *
     * @return string
     */
    public function getRefAmount()
    {
        return $this->refAmount;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Payment
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set created
     *
     * @param string $created
     *
     * @return Payment
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }
}

