<?php

namespace App\Infrastructure\Persistence\Eloquent;

use App\Domain\Book\Book;
use App\Domain\Book\BookRepositoryInterface;
use App\Domain\Book\DateTime;

class EloquentBookRepository implements BookRepositoryInterface
{
    public function findById(string $id): ?Book
    {
        $bookModel = BookModel::find($id);
        
        if (!$bookModel) {
            return null;
        }

        return $this->toEntity($bookModel);
    }

    public function findAll(): array
    {
        return BookModel::all()->map(function ($bookModel) {
            return $this->toEntity($bookModel);
        })->toArray();
    }

    public function save(Book $book): void
    {
        BookModel::create([
            'id' => $book->getId(),
            'title' => $book->getTitle(),
            'author' => $book->getAuthor(),
            'isbn' => $book->getIsbn(),
            'quantity' => $book->getQuantity()
        ]);
    }

    public function update(Book $book): void
    {
        BookModel::where('id', $book->getId())
            ->update([
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'isbn' => $book->getIsbn(),
                'quantity' => $book->getQuantity()
            ]);
    }

    public function delete(string $id): void
    {
        BookModel::destroy($id);
    }

    private function toEntity(BookModel $bookModel): Book
    {
        return new Book(
            $bookModel->id,
            $bookModel->title,
            $bookModel->author,
            $bookModel->isbn,
            $bookModel->quantity,
            new DateTime($bookModel->created_at)
        );
    }
}