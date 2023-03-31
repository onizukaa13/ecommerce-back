<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $numerofacture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumerofacture(): ?string
    {
        return $this->numerofacture;
    }

    public function setNumerofacture(?string $numerofacture): self
    {
        $this->numerofacture = $numerofacture;

        return $this;
    }
}
