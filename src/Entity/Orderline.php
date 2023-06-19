<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderlineRepository;
#[ApiResource]
#[ORM\Entity(repositoryClass: OrderlineRepository::class)]
class Orderline
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $articleId;

    #[ORM\Column]
    private ?int $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleId(): ?int
    {
        return $this->articleId;
    }

    public function setArticleId(?int $articleId): void
    {
        $this->articleId = $articleId;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }
}
