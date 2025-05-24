<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BooksTableSeeder extends Seeder
{
    public function run(): void
    {
        // Limpiar la tabla antes de insertar nuevos datos
        DB::table('books')->truncate();

        DB::table('books')->insert([
            [
                'id' => uniqid(),
                'title' => 'El Quijote',
                'author' => 'Miguel de Cervantes',
                'isbn' => '9788424922580',
                'quantity' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => uniqid(),
                'title' => 'Cien años de soledad',
                'author' => 'Gabriel García Márquez',
                'isbn' => '9780307474728',
                'quantity' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        // Eliminar los datos actuales de la tabla antes de insertar nuevos registros
        DB::table('books')->delete();

        // Agregar 100 libros adicionales
        $books = [
            ['title' => 'Don Quijote de la Mancha', 'author' => 'Miguel de Cervantes', 'isbn' => '9788424922580', 'quantity' => 5],
            ['title' => 'Cien años de soledad', 'author' => 'Gabriel García Márquez', 'isbn' => '9780307474728', 'quantity' => 3],
            ['title' => 'La sombra del viento', 'author' => 'Carlos Ruiz Zafón', 'isbn' => '9788408172177', 'quantity' => 7],
            ['title' => 'El amor en los tiempos del cólera', 'author' => 'Gabriel García Márquez', 'isbn' => '9780307389732', 'quantity' => 4],
            ['title' => '1984', 'author' => 'George Orwell', 'isbn' => '9780451524935', 'quantity' => 10],
            ['title' => 'Crimen y castigo', 'author' => 'Fiódor Dostoyevski', 'isbn' => '9780140449136', 'quantity' => 6],
            ['title' => 'El principito', 'author' => 'Antoine de Saint-Exupéry', 'isbn' => '9780156012195', 'quantity' => 15],
            ['title' => 'Rayuela', 'author' => 'Julio Cortázar', 'isbn' => '9788466331956', 'quantity' => 8],
            ['title' => 'La casa de los espíritus', 'author' => 'Isabel Allende', 'isbn' => '9780553383805', 'quantity' => 9],
            ['title' => 'Fahrenheit 451', 'author' => 'Ray Bradbury', 'isbn' => '9781451673319', 'quantity' => 12],
            // ... Agregar más libros hasta llegar a 100 ...
        ];

        foreach ($books as $book) {
            // Verificar y generar un ISBN único
            $isbn = $book['isbn'];
            while (DB::table('books')->where('isbn', $isbn)->exists()) {
                $isbn = '978' . rand(1000000000, 9999999999); // Generar un ISBN único

                // Registrar en los logs para depuración
                logger()->info("Generando nuevo ISBN para evitar duplicados: {$isbn}");
            }

            DB::table('books')->insert([
                'id' => (string) Str::uuid(),
                'title' => $book['title'],
                'author' => $book['author'],
                'isbn' => $isbn,
                'quantity' => $book['quantity'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Agregar libros en inglés
        $englishBooks = [
            ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee', 'isbn' => '9780061120084', 'quantity' => 10],
            ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'isbn' => '9780743273565', 'quantity' => 8],
            ['title' => '1984', 'author' => 'George Orwell', 'isbn' => '9780451524935', 'quantity' => 12],
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen', 'isbn' => '9780141439518', 'quantity' => 7],
            ['title' => 'The Catcher in the Rye', 'author' => 'J.D. Salinger', 'isbn' => '9780316769488', 'quantity' => 9],
        ];

        foreach ($englishBooks as $book) {
            $isbn = $book['isbn'];
            while (DB::table('books')->where('isbn', $isbn)->exists()) {
                $isbn = '978' . rand(1000000000, 9999999999); // Generar un ISBN único
            }

            DB::table('books')->insert([
                'id' => (string) Str::uuid(),
                'title' => $book['title'],
                'author' => $book['author'],
                'isbn' => $isbn,
                'quantity' => $book['quantity'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
