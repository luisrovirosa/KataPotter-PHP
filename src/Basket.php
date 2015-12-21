<?php

namespace KataPotter;

class Basket
{
    /** @var Book[] */
    private $books;
    /**
     * @var Discounts
     */
    private $discounts;

    /**
     * Basket constructor.
     * @param Book[] $books
     * @param Discounts $discounts
     */
    public function __construct(array $books, Discounts $discounts)
    {
        $this->books = $books;
        $this->discounts = $discounts;
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
        return $this->numberOfBooks() * Book::PRICE;
    }

    /**
     * @return int
     */
    private function discount()
    {
        return $this->discounts->calculate($this->books);
    }

    /**
     * @return int
     */
    private function numberOfBooks()
    {
        return count($this->books);
    }
}