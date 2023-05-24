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
                'title' => 'Symfony pour les développeurs',
                'description' => 'Un guide complet pour apprendre Symfony',
                'author' => 'John Smith',
                'price' => 29.99,
                'image' => 'https://example.com/images/symfony_for_developers.jpg',
                'isbn' => '9783456789012',
                'stock' => 'Disponible',
                'genre' => 'Informatique',
                'format' => 'Broché'
            ],
            [
                'title' => 'Les Misérables',
                'description' => 'Un roman historique',
                'author' => 'Victor Hugo',
                'price' => 14.99,
                'image' => 'https://cdn1.booknode.com/book_cover/83/les_miserables-83116-264-432.jpg',
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
                'image' => 'https://media.groupe.gallimard.fr/couvHD/A64513.jpg',
                'isbn' => '9782070416705',
                'stock' => 'Disponible',
                'genre' => "Roman d'aventure",
                'format' => 'Poche',
            ],

            [
                'title' =>'Harry Potter',
                'description' => 'Un roman fantastique rempli de magie et d\'aventure',
                'author' => 'J.K. Rowling',
                'price' =>  15.99,
                'image' => 'https://m.media-amazon.com/images/I/813JfJQwefL.jpg',
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
                'image' => 'https://cdn1.booknode.com/book_cover/1393/cherub_tome_2_trafic-1393090-264-432.jpg',
                'isbn' => '9782203133158',
                'stock' => 'Disponible',
                'genre' => 'Roman d\espionnage',
                'format' => 'Poche',
            ],

            [   'title' => 'Encyclopédie des animaux',
                'description' => 'Découvrez le monde fascinant des animaux',
                'author' => 'John Doe',
                'price' => 19.99,
                'image' => 'https://example.com/images/encyclopedia_of_animals.jpg',
                'isbn' => '9781234567890',
                'stock' => 'Disponible',
                'genre' => 'Livre animalier',
                'format' => 'Relié'
            ],

            [   'title' => 'Le Petit Prince',
                'description' => 'Un conte poétique et philosophique',
                'author' => 'Antoine de Saint-Exupéry',
                'price' => 9.99,
                'image' => 'https://example.com/images/le_petit_prince.jpg',
                'isbn' => '9782345678901',
                'stock' => 'Disponible',
                'genre' => 'Conte',
                'format' => 'Broché'
            ]




          
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
