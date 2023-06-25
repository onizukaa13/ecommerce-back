<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\OrderlineRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
#[ApiResource(
    normalizationContext: ["groups" => ["orderline:read"]],
    denormalizationContext: ["groups" => ["orderline:write"]]
)]

#[ORM\Entity(repositoryClass: OrderlineRepository::class)]

class Orderline
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["orderline:read","orderline:write","order:read"])]
    private ?int $id = null;
    
    #[Groups(["order:write", "order:read","orderline:write"])]
    #[ORM\ManyToOne(inversedBy:'orderlines',cascade:['persist'])]
    private ?Order $order = null;
   
    #[ORM\ManyToOne(inversedBy:'orderlines',cascade:['persist'])]
    #[Groups(["order:write", "order:read","orderline:write","orderline:read"])]
    private ?Book $book = null;

    #[Groups(["orderline:read","orderline:write","order:read","order:write"])]
    #[ORM\Column(type:'integer',nullable:false)]
    private $quantity;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity( int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * Get the value of order
     */ 
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set the value of order
     *
     * @return  self
     */ 
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get the value of book
     */ 

    /**
     * Get the value of book
     */ 

    /**
     * Get the value of book
     */ 

    /**
     * Get the value of book
     */ 
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set the value of book
     *
     * @return  self
     */ 
    public function setBook($book)
    {
        $this->book = $book;

        return $this;
    }

}