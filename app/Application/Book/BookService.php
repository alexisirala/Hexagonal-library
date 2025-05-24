<?php

namespace App\Application\Book;

use App\Domain\Book\Book;
use App\Domain\Book\BookRepositoryInterface;

class BookService
{
    private BookRepositoryInterface $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function createBook(string $title, string $author, string $isbn, int $quantity): Book
    {
        $book = new Book(
            uniqid(),
            $title,
            $author,
            $isbn,
            $quantity
        );

        $this->bookRepository->save($book);

        return $book;
    }

    public function getAllBooks(): array
    {
        return $this->bookRepository->findAll();
    }

    public function getBookById(string $id): ?Book
    {
        return $this->bookRepository->findById($id);
    }

    public function updateBook(string $id, string $title, string $author, string $isbn, int $quantity): ?Book
    {
        $book = $this->bookRepository->findById($id);
        
        if (!$book) {
            return null;
        }

        $updatedBook = new Book(
            $id,
            $title,
            $author,
            $isbn,
            $quantity,
            $book->getCreatedAt()
        );

        $this->bookRepository->update($updatedBook);

        return $updatedBook;
    }

    public function deleteBook(string $id): bool
    {
        $book = $this->bookRepository->findById($id);
        
        if (!$book) {
            return false;
        }

        $this->bookRepository->delete($id);
        return true;
    }
}