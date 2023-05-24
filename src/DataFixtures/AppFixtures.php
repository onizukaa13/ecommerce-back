<?php

namespace App\DataFixtures;

use App\Entity\Book;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $books = [
            [
                'title' => 'Le Seigneur des Anneaux',
                'description' => 'Une épopée fantastique',
                'author' => 'J.R.R. Tolkien',
                'price' => 19.99,
                'image' => '...',
                'isbn' => '1234567890',
                'stock' => 'Disponible',
                'genre' => 'Fantasy',
                'format' => 'Poche'
            ],
            [
                'title' => 'Les Misérables',
                'description' => 'Un roman historique',
                'author' => 'Victor Hugo',
                'price' => 14.99,
                'image' => '...',
                'isbn' => '9782070404672',
                'stock' => 'Disponible',
                'genre' => 'Roman historique',
                'format' => 'Broché',
            ],
            [
                'title' => 'Le Comte de Monte-Cristo',
                'description' => "Un roman d'aventure et de vengeance",
                'author' => 'Alexandre Dumas',
                'price' => 12.50,
                'image' => '...',
                'isbn' => '9782070416705',
                'stock' => 'Disponible',
                'genre' => "Roman d'aventure",
                'format' => 'Poche',
            ],

            [
                'title' =>'Harry Potter',
                'description' => 'Un roman fantastique rempli de magie et d\aventure',
                'author' => 'J.K. Rowling',
                'price' =>  15.99,
                'image' => '...',
                'isbn' => '9782070584622',
                'stock' => 'Disponible',
                'genre' => 'Roman fantastique',
                'format' => 'Broché',
            ],

            [
                'title' => 'Cherub, Trafic',
                'description' => 'Un roman d\'espionnage captivant',
                'author' => 'Robert Muchamore',
                'price' => 10.99,
                'image' => '...',
                'isbn' => '9782203133158',
                'stock' => 'Disponible',
                'genre' => 'Roman d\espionnage',
                'format' => 'Poche',
            ],


          
        ];

        foreach ($books as $bookData) {
            $book = new Book();
            $book->setTitre($bookData['title']);
            $book->setDescription($bookData['description']);
            $book->setAuthor($bookData['author']);
            $book->setPrix($bookData['price']);
            $book->setImage($bookData['image']);
            $book->setIsbn($bookData['isbn']);
            $book->setStock($bookData['stock']);
            $book->setGenre($bookData['genre']);
            $book->setFormat($bookData['format']);

            $manager->persist($book);
        }

        $manager->flush();
    }
}
