<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function save(Order $order, bool $flush = false): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($order);

        if ($flush) {
            $entityManager->flush();
        }
    }

    public function remove(Order $order, bool $flush = false): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($order);

        if ($flush) {
            $entityManager->flush();
        }
    }
}
