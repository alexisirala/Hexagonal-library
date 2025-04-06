<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Book\Book;
use App\Domain\Book\BookRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BookRepository implements BookRepositoryInterface
{
    public function findById(string $id): ?Book
    {
        $bookData = DB::table('books')->where('id', $id)->first();

        if (!$bookData) {
            return null;
        }

        return new Book(
            $bookData->id,
            $bookData->title,
            $bookData->author,
            $bookData->isbn,
            $bookData->quantity
        );
    }

    public function findAll(): array
    {
        $booksData = DB::table('books')->get();

        return $booksData->map(function ($bookData) {
            return new Book(
                $bookData->id,
                $bookData->title,
                $bookData->author,
                $bookData->isbn,
                $bookData->quantity
            );
        })->all();
    }

    public function save(Book $book): void
    {
        DB::table('books')->insert([
            'id' => $book->getId(),
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'isbn' => $book->getIsbn(),
            'quantity' => $book->getQuantity()
        ]);
    }

    public function update(Book $book): void
    {
        DB::table('books')
            ->where('id', $book->getId())
            ->update([
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'isbn' => $book->getIsbn(),
                'quantity' => $book->getQuantity()
            ]);
    }

    public function delete(string $id): void
    {
        DB::table('books')->where('id', $id)->delete();
    }
}