<?php

namespace DropBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="DropBundle\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="It looks like your already have an account!")
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     *
     */
    private $email;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * The encoded password
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * A non-persisted field that's used to create the encoded password
     *
     * @Assert\NotBlank()
     */
    private $plainPassword;

    /**
     * @ORM\Column(name="phone", type="string", length=20, unique=true)
     */
    private $phone;

    /**
     * @ORM\Column(name="skype", type="string", length=50, unique=true, nullable=true)
     */
    private $skype;

    /**
     * @ORM\Column(name="cards_number", type="string", length=20, nullable=true)
     */
    private $cardsNumber;

    /**
     * @ORM\Column(name="ref_link", type="string", length=255, unique=true, nullable=true)
     */
    private $refLink;

    /**
     * One User has Many Orders
     *
     * @ORM\OneToMany(targetEntity="Ord", mappedBy="user")
     */
    private $orders;

    /**
     * @ORM\Column(name="cards_owner_name", type="string", length=255, nullable=true)
     */
    private $cardsOwnerName;

    /**
     * User constructor.
     */
    public function __construct() {
        $this->orders = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->password = null;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $skype
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;
    }

    /**
     * @return string
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * @param string $cardsNumber
     */
    public function setCardsNumber($cardsNumber)
    {
        $this->cardsNumber = $cardsNumber;
    }

    /**
     * @return string
     */
    public function getCardsNumber()
    {
        return $this->cardsNumber;
    }

    /**
     * @param string $refLink
     */
    public function setRefLink($refLink)
    {
        $this->refLink = $refLink;
    }

    /**
     * @return string
     */
    public function getRefLink()
    {
        return $this->refLink;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    /**
     * @return ArrayCollection
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param Ord $order
     */
    public function addOrders($order)
    {
        $this->orders[] = $order;
    }

    /**
     * @return string
     */
    public function getCardsOwnerName()
    {
        return $this->cardsOwnerName;
    }

    /**
     * @param string $cardsOwnerName
     */
    public function setCardsOwnerName($cardsOwnerName)
    {
        $this->cardsOwnerName = $cardsOwnerName;
    }

}

