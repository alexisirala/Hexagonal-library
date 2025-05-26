<?php

namespace App\Domain\Book;

use DateTime;

class Book
{
    private string $id;
    private string $title;
    private string $author;
    private string $isbn;
    private int $quantity;
    private ?DateTime $createdAt;

    public function __construct(
        string $id,
        string $title,
        string $author,
        string $isbn,
        int $quantity,
        ?DateTime $createdAt = null
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->quantity = $quantity;
        $this->createdAt = $createdAt;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'isbn' => $this->isbn,
            'quantity' => $this->quantity,
            'created_at' => $this->createdAt ? $this->createdAt->format('Y-m-d\TH:i:s.u\Z') : null,
            'updated_at' => $this->createdAt ? $this->createdAt->format('Y-m-d\TH:i:s.u\Z') : null,
        ];
    }
}