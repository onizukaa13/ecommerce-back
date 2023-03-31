<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Book;

class BookController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @Route("/books", name="book_list", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Récupération des livres selon les critères souhaités
        $books = $entityManager->createQueryBuilder()
            ->select('b')
            ->from(Book::class, 'b')
            ->where('b.prix < :prixMax')
            ->andWhere('b.auteur = :auteur')
            ->andWhere('b.genre = :genre')
            ->andWhere('b.stock > 0')
            ->orderBy('b.nbVentes', 'DESC')
            ->setParameter('prixMax', 50) // exemple de prix maximum souhaité
            ->setParameter('auteur', 'Tolkien') // exemple d'auteur souhaité
            ->setParameter('genre', 'Fantasy') // exemple de genre souhaité
            ->getQuery()
            ->getResult();
        
        return $this->json($books);
    }

    
}
