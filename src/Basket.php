<?php

namespace KataPotter;

class Basket
{
    /** @var Book[] */
    private $books;

    /**
     * Basket constructor.
     * @param Book[] $books
     */
    public function __construct(array $books)
    {
        $this->books = $books;
    }

    public function price()
    {
        return count($this->books) * 8;
    }
}