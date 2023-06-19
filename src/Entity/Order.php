<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\OrderRepository;
use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: ["groups" => ["order:write"]],
    denormalizationContext: ["groups" => ["order:write"]]
)]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["order:write"])]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime')]
    #[Groups(["order:write"])]
    private \DateTimeInterface $orderDate;

    #[Groups(["order:write"])]
    #[ORM\Column(type: 'string', unique: true)]
    private string $orderNumber;

    #[ORM\ManyToOne]
    #[Groups(["order:write"])]
    private ?User $user = null;



    public function __construct()
    {
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
