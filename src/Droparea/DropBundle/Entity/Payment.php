<?php

namespace Droparea\DropBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Table(name="payment")
 * @ORM\Entity(repositoryClass="Droparea\DropBundle\Repository\PaymentRepository")
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
     * @ORM\Column(name="Ñamount", type="string", length=255)
     */
    private $Ñamount;

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
     * Set Ñamount
     *
     * @param string $Ñamount
     *
     * @return Payment
     */
    public function setÑamount($Ñamount)
    {
        $this->Ñamount = $Ñamount;

        return $this;
    }

    /**
     * Get Ñamount
     *
     * @return string
     */
    public function getÑamount()
    {
        return $this->Ñamount;
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

