<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $numero = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $date = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $totalHt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Article $totalTtc = null;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: User::class)]
    private Collection $client;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: Article::class)]
    private Collection $lignescommande;

    public function __construct()
    {
        $this->client = new ArrayCollection();
        $this->lignescommande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?\DateTimeInterface
    {
        return $this->numero;
    }

    public function setNumero(\DateTimeInterface $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTotalHt(): ?string
    {
        return $this->totalHt;
    }

    public function setTotalHt(string $totalHt): self
    {
        $this->totalHt = $totalHt;

        return $this;
    }

    public function getTotalTtc(): ?Article
    {
        return $this->totalTtc;
    }

    public function setTotalTtc(?Article $totalTtc): self
    {
        $this->totalTtc = $totalTtc;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(User $client): self
    {
        if (!$this->client->contains($client)) {
            $this->client->add($client);
            $client->setCommande($this);
        }

        return $this;
    }

    public function removeClient(User $client): self
    {
        if ($this->client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getCommande() === $this) {
                $client->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getLignescommande(): Collection
    {
        return $this->lignescommande;
    }

    public function addLignescommande(Article $lignescommande): self
    {
        if (!$this->lignescommande->contains($lignescommande)) {
            $this->lignescommande->add($lignescommande);
            $lignescommande->setCommande($this);
        }

        return $this;
    }

    public function removeLignescommande(Article $lignescommande): self
    {
        if ($this->lignescommande->removeElement($lignescommande)) {
            // set the owning side to null (unless already changed)
            if ($lignescommande->getCommande() === $this) {
                $lignescommande->setCommande(null);
            }
        }

        return $this;
    }
}
