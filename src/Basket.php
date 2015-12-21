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
        return $this->normalPrice() - $this->discount();
    }

    /**
     * @return int
     */
    private function normalPrice()
    {
        return $this->numberOfBooks() * 8;
    }

    /**
     * @return int
     */
    private function discount()
    {
        $discount = 0;
        if ($this->numberOfBooks() == 2 && $this->books[0] != $this->books[1]) {
            $discount = 5 / 100;
        }

        return $discount * $this->normalPrice();
    }

    /**
     * @return int
     */
    private function numberOfBooks()
    {
        return count($this->books);
    }
}