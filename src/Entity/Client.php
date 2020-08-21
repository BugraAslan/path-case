<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 * @ORM\Table(name="clients")
 */
class Client implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=55, nullable=false, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status = 0;

    /**
     * @var ArrayCollection|Orders[]
     * @ORM\OneToMany(targetEntity="Orders", mappedBy="clientId")
     */
    protected $orders;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return Client
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getRoles()
    {
        return ['USER_ROLES'];
    }

    public function getSalt()
    {

    }

    public function eraseCredentials()
    {

    }

    /**
     * @return Orders[]|ArrayCollection
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
     * @param Orders[]|ArrayCollection $orders
     * @return Client
     */
    public function setOrders($orders)
    {
        $this->orders = $orders;
        return $this;
    }
}
