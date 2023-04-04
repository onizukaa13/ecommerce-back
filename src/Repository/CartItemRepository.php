<?php

namespace App\Repository;

use App\Entity\CartItem;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CartItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartItem::class);
    }

    public function findByUserAndProduct(User $user, Product $product): ?CartItem
    {
        return $this->findOneBy([
            'user' => $user,
            'product' => $product,
        ]);
    }
}
