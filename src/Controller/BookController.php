<?php

// src/Controller/BookController.php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    public function __construct(private BookRepository $bookRepository){

    }
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $books = $this->bookRepository->findAll();

        return $this->render('book/index.html.twig', [
            'books' => $books,
        ]);
    }
}
