<?php

namespace KataPotter\Discounts;

use KataPotter\Book;
use KataPotter\Books;

class FivePercentDiscountOnTwoDifferentBooks implements Discount
{
    public function match(Books $books)
    {
        return $this->hasTwoDifferentBooks($books);
    }

    public function amount(Books $books)
    {
        return 5 / 100 * 2 * Book::PRICE;
    }

    private function hasTwoDifferentBooks(Books $books)
    {
        $bookNames = $books->names();

        return count(array_unique($bookNames)) == 2;
    }
}