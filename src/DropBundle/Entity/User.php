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
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     *
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     *
     * The encoded password
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * A non-persisted field that's used to create the encoded password.
     * @Assert\NotBlank()
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, unique=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="skype", type="string", length=255, unique=true, nullable=true)
     */
    private $skype;

    /**
     * @var string
     *
     * @ORM\Column(name="cards_number", type="string", length=255, nullable=true)
     */
    private $cardsNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="ref_link", type="string", length=255, unique=true, nullable=true)
     */
    private $refLink;

    /**
     * One User has Many Orders.
     * @ORM\OneToMany(targetEntity="Ord", mappedBy="user")
     */
    private $orders;

    /**
     * @var string
     * @ORM\Column(name="cards_owner_name", type="string", length=255, nullable=true)
     */
    private $cardsOwnerName;

    /**
     * User constructor.
     */
    public function __construct() {
        $this->orders = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

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
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
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
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set skype
     *
     * @param string $skype
     *
     * @return User
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;

        return $this;
    }

    /**
     * Get skype
     *
     * @return string
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * Set cardsNumber
     *
     * @param string $cardsNumber
     *
     * @return User
     */
    public function setCardsNumber($cardsNumber)
    {
        $this->cardsNumber = $cardsNumber;

        return $this;
    }

    /**
     * Get cardsNumber
     *
     * @return string
     */
    public function getCardsNumber()
    {
        return $this->cardsNumber;
    }

    /**
     * Set refLink
     *
     * @param string $refLink
     *
     * @return User
     */
    public function setRefLink($refLink)
    {
        $this->refLink = $refLink;

        return $this;
    }

    /**
     * Get refLink
     *
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
     * @return mixed
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param mixed $orders
     */
    public function setOrders($orders)
    {
        $this->orders = $orders;
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

