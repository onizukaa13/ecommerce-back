<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookRepository;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderlineRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ApiResource(
    normalizationContext: ["groups" => ["book:read"]],
    denormalizationContext: ["groups" => ["book:write"]]
)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["book:read", "book:write", "orderline:read", "order:read",])]
    private ?int $id = null;

    #[Groups(["book:read", "book:write", "orderline:read", "orderline:write", "order:read", "order:write"])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titre = null;

    #[Groups(["book:read", "book:write", "orderline:read", "orderline:write", "order:read", "order:write"])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $author = null;

    #[Groups(["book:read", "book:write", "orderline:read", "orderline:write", "order:read", "order:write"])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[Groups(["book:read", "book:write", "orderline:read", "orderline:write", "order:read", "order:write"])]
    #[ORM\Column]
    private ?string $image = null;

    #[Groups(["book:read", "book:write", "orderline:read", "orderline:write", "order:read", "order:write"])]
    #[ORM\Column]
    private ?int $prix = null;

    #[Groups(["book:read", "book:write", "orderline:read", "orderline:write", "order:read", "order:write"])]
    #[ORM\Column(length: 13, nullable: true)]
    private ?int $stock = null;

    #[Groups(["book:read", "book:write", "orderline:read", "orderline:write", "order:read", "order:write"])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $isbn = null;

    #[Groups(["book:read", "book:write", "orderline:read", "orderline:write", "order:read", "order:write"])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $genre = null;

    #[Groups(["book:read", "book:write", "orderline:read", "orderline:write", "order:read", "order:write"])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $format = null;

    #[Groups(["book:read", "book:write", "order:write"])]
    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Orderline::class, cascade: ['persist'])]
    private Collection $orderlines;

    public function __construct()
    {
        $this->orderlines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $auteur): self
    {
        $this->author = $auteur;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getIsbn(): ?string
    {
        return $this->isbn;
    }

    public function setIsbn(?string $isbn): self
    {
        $this->isbn = $isbn;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getFormat(): ?string
    {
        return $this->format;
    }

    public function setFormat(?string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getOrderlines(): Collection
    {
        return $this->orderlines;
    }

    public function addOrderlines(Orderline $orderlines): self
    {
        if (!$this->orderlines->contains($orderlines)) {
            $this->orderlines->add($orderlines);
            $orderlines->setBook($this);
        }

        return $this;
    }

    public function removeOrderlines(Orderline $orderlines): self
    {
        if ($this->orderlines->removeElement($orderlines)) {
            if ($orderlines->getBook() === $this) {
                $orderlines->setBook(null);
            }
        }

        return $this;
    }
}
