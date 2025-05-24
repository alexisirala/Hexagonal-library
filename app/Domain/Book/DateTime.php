<?php

namespace App\Domain\Book;

class DateTime extends \DateTime
{
    public function __construct(string $datetime = 'now')
    {
        parent::__construct($datetime);
    }
}