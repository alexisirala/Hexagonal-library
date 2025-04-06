<?php

namespace Database\Seeders;

use App\Domain\Book\Book;
use App\Infrastructure\Persistence\Eloquent\EloquentBookRepository;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class SpanishBooksSeeder extends Seeder
{
    public function __construct(private EloquentBookRepository $bookRepository)
    {}

    public function run(): void
    {
        $books = [
            [
                'title' => 'Cien años de soledad',
                'author' => 'Gabriel García Márquez',
                'isbn' => '978-0307474728',
                'quantity' => 10
            ],
            [
                'title' => 'Don Quijote de la Mancha',
                'author' => 'Miguel de Cervantes',
                'isbn' => '978-8424938437',
                'quantity' => 15
            ],
            [
                'title' => 'La casa de los espíritus',
                'author' => 'Isabel Allende',
                'isbn' => '978-0525433477',
                'quantity' => 8
            ],
            [
                'title' => 'Rayuela',
                'author' => 'Julio Cortázar',
                'isbn' => '978-8437604572',
                'quantity' => 12
            ],
            [
                'title' => 'La sombra del viento',
                'author' => 'Carlos Ruiz Zafón',
                'isbn' => '978-0143126393',
                'quantity' => 10
            ],
            [
                'title' => 'Pedro Páramo',
                'author' => 'Juan Rulfo',
                'isbn' => '978-0802133908',
                'quantity' => 7
            ],
            [
                'title' => 'La ciudad y los perros',
                'author' => 'Mario Vargas Llosa',
                'isbn' => '978-8420471839',
                'quantity' => 9
            ],
            [
                'title' => 'Ficciones',
                'author' => 'Jorge Luis Borges',
                'isbn' => '978-0802130303',
                'quantity' => 11
            ],
            [
                'title' => 'Como agua para chocolate',
                'author' => 'Laura Esquivel',
                'isbn' => '978-0385420174',
                'quantity' => 8
            ],
            [
                'title' => 'La familia de Pascual Duarte',
                'author' => 'Camilo José Cela',
                'isbn' => '978-8423342766',
                'quantity' => 6
            ]
        ];

        foreach ($books as $bookData) {
            $book = new Book(
                Uuid::uuid4()->toString(),
                $bookData['title'],
                $bookData['author'],
                $bookData['isbn'],
                $bookData['quantity']
            );

            $this->bookRepository->save($book);
        }
    }
}