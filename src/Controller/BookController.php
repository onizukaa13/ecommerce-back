<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;

class BookController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @Route("/books", name="book_list", methods={"GET"})
     */ /**
     * @Route("/books/{id}", name="book_show", methods={"GET"})
     */
    public function show(Book $book): JsonResponse
    {
        return $this->json($book);
    }
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $criteria = $request->query->all();

        // Récupération des livres selon les critères souhaités
        $queryBuilder = $entityManager->createQueryBuilder()
            ->select('b')
            ->from(Book::class, 'b')
            ->where('b.stock > 0');

        if (isset($criteria['auteur'])) {
            $queryBuilder->andWhere('b.auteur LIKE :auteur')
                ->setParameter('auteur', '%' . $criteria['auteur'] . '%');
        }

        if (isset($criteria['titre'])) {
            $queryBuilder->andWhere('b.titre LIKE :titre')
                ->setParameter('titre', '%' . $criteria['titre'] . '%');
        }

        if (isset($criteria['genre'])) {
            $queryBuilder->andWhere('b.genre = :genre')
                ->setParameter('genre', $criteria['genre']);
        }

        if (isset($criteria['prixMax'])) {
            $queryBuilder->andWhere('b.prix < :prixMax')
                ->setParameter('prixMax', $criteria['prixMax']);
        }

        $books = $queryBuilder->orderBy('b.nbVentes', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->json($books);
    }
}
