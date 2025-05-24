<?php

namespace App\Domain\Book;

interface BookRepositoryInterface
{
    public function findById(string $id): ?Book;
    public function findAll(): array;
    public function save(Book $book): void;
    public function update(Book $book): void;
    public function delete(string $id): void;
}