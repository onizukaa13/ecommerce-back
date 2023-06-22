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
                'title' => 'HACKING POUR DÉBUTANT',
                'description' => 'La sécurité informatique',
                'author' => 'B. Anass ',
                'price' => 19.99,
                'image' => 'https://m.media-amazon.com/images/P/1689853077.01._SCLZZZZZZZ_SX500_.jpg',
                'isbn' => '9783456789012',
                'stock' => '10',
                'genre' => 'Informatique',
                'format' => 'Broché'
            ],
            [
                'title' => 'En route pour Symfony 5',
                'description' => 'Livre pour en apprendre plus sur Symfony',
                'author' => ' Fabien Potencier ',
                'price' => 43.94,
                'image' => 'https://m.media-amazon.com/images/I/51Dd6bp9gwL._SX331_BO1,204,203,200_.jpg',
                'isbn' => '9782070404672',
                'stock' => '10',
                'genre' => 'Informatique',
                'format' => 'Broché',
            ],
            [
                'title' => 'La Pogrammation pour les Débutants Absolus',
                'description' => "Le Moyen le plus Simple d'entrer dans le Monde de la Programmation Informatique",
                'author' => ' Alan Grid',
                'price' => 13.57,
                'image' => 'https://m.media-amazon.com/images/P/B0BW2SL55W.01._SCLZZZZZZZ_SX500_.jpg',
                'isbn' => '9782070416705',
                'stock' => '10',
                'genre' => "Informatique",
                'format' => 'Broché',
            ],

            [
                'title' =>'Python & JavaScript pour les Nuls',
                'description' => "Un livre idéal pour rentre dans l'univers de la programmation en Python et en JavaScript",
                'author' => 'John Paul Mueller',
                'price' =>  22.95,
                'image' => 'https://m.media-amazon.com/images/P/B08HGV1D9C.01._SCLZZZZZZZ_SX500_.jpg',
                'isbn' => '9782070584622',
                'stock' => '10',
                'genre' => 'Informatique',
                'format' => 'Broché',
            ],

            [
                'title' => 'Programmation Arduino',
                'description' => 'Développez rapidement vos premiers programmes',
                'author' => 'Simon Monk',
                'price' => 19.90,
                'image' => 'https://m.media-amazon.com/images/P/B08GG5KCFV.01._SCLZZZZZZZ_SX500_.jpg.',
                'isbn' => '9782203133158',
                'stock' => '10',
                'genre' => 'Informatique',
                'format' => 'Broché',
            ],

            [   'title' => 'React',
                'description' => 'Développez le Front End de vos applications web et mobiles avec JavaScript',
                'author' => 'Sébastien Castiel ',
                'price' => 39.00,
                'image' => 'https://m.media-amazon.com/images/P/2409022723.01._SCLZZZZZZZ_SX500_.jpg',
                'isbn' => '9781234567890',
                'stock' => '10',
                'genre' => 'Informatique',
                'format' => 'Broché'
            ],

            [   'title' => 'The Road to React',
                'description' => 'Votre parcours pour maîtriser React.js',
                'author' => 'Robin Wieruch',
                'price' => 29.63,
                'image' => 'https://m.media-amazon.com/images/P/172004399X.01._SCLZZZZZZZ_SX500_.jpg',
                'isbn' => '9782345678901',
                'stock' => '10',
                'genre' => 'Informatique',
                'format' => 'Broché'
            ],

            [  'title' => "L'intelligence Artificielle",
                'description' => "Les enjeux d'aujourd'hui et de demain",
                'author' => 'Éditions FuturTech',
                'price' => 19.90,
                'image' => 'https://m.media-amazon.com/images/P/B0BRYWHZJC.01._SCLZZZZZZZ_SX500_.jpg',
                'isbn' => '9781234567890',
                'stock' => '10',
                'genre' => 'Informatique',
                'format' => 'Relié'

            ],
            [
                'title' => 'Tout JavaScript ',
                'description' => "Maitriser l’ensemble des fonctionnalités du JavaScript",
                'author' => 'Olivier Hondermarck  ',
                'price' => 29.90,
                'image' => 'https://m.media-amazon.com/images/P/2100846272.01._SCLZZZZZZZ_SX500_.jpg',
                'isbn' => '9789876543210',
                'stock' => '10',
                'genre' => 'Informatique',
                'format' => 'Broché',
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
