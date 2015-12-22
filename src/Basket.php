<?php

namespace KataPotter;

class Basket
{
    /** @var Books */
    private $books;
    /**
     * @var Discounts
     */
    private $discounts;

    /**
     * Basket constructor.
     * @param Books $books
     * @param Discounts $discounts
     */
    public function __construct(Books $books, Discounts $discounts)
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
        return $this->books->price();
    }

    /**
     * @return int
     */
    private function discount()
    {
        return $this->discounts->calculate($this->books);
    }
}