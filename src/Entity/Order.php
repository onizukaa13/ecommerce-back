<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrderRepository;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ["groups" => ["order:read"]],
    denormalizationContext: ["groups" => ["order:write"]]
)]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["order:write", "order:read", "orderline:read"])]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime')]
    #[Groups(["order:write", "order:read", "orderline:read", "orderline:write"])]
    private \DateTimeInterface $orderDate;

    #[Groups(["order:write", "order:read", "orderline:read", "orderline:write"])]
    #[ORM\Column(type: 'string', unique: true)]
    private string $orderNumber;

    #[ORM\ManyToOne(inversedBy: 'orders', cascade: ['persist'])]
    #[Groups(["order:write", "order:read", "orderline:read", "orderline:write"])]
    private ?User $user = null;

    #[Groups(["order:write", "order:read", "orderline:write","orderline:read"])]
    #[ORM\OneToMany(mappedBy: 'order', targetEntity: Orderline::class, cascade: ['persist'])]
    private  $orderlines;

    public function __construct()
    {
        $this->orderlines = new ArrayCollection();
        $this->orderDate = new \DateTime();
        $this->orderNumber = $this->generateOrderNumber(); // Génère un numéro de commande unique
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): \DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;
        return $this;
    }

    public function getOrderNumber(): string
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(string $orderNumber): self
    {
        $this->orderNumber = $orderNumber;
        return $this;
    }



    private function generateOrderNumber(): string
    {
        // Logique pour générer un numéro de commande unique
        // Par exemple, vous pouvez combiner la date actuelle avec un identifiant unique

        $timestamp = time();
        $uniqueId = uniqid();

        return date('YmdHis', $timestamp) . '-' . $uniqueId;
    }
    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of orderline
     */
    public function getOrderlines()
    {
        return $this->orderlines;
    }

    /**
     * Set the value of orderline
     *
     * @return  self
     */
    public function setOrderlines($orderlines)
    {
        $this->orderlines = $orderlines;

        return $this;
    }
    public function addOrderline(Orderline $orderline): self
    {
        if (!$this->orderlines->contains($orderline)) {
            $this->orderlines->add($orderline);
            $orderline->setOrder($this);
        }

        return $this;
    }

    public function removeOrderline(Orderline $orderline): self
    {
        if ($this->orderlines->removeElement($orderline)) {
            if ($orderline->getBook() === $this) {
                $orderline->setOrder(null);
            }
        }

        return $this;
    }
}