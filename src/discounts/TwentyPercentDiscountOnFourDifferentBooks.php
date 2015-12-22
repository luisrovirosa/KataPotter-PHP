<?php

namespace KataPotter\Discounts;

use KataPotter\Book;
use KataPotter\Books;

class TwentyPercentDiscountOnFourDifferentBooks implements Discount
{

    public function match(Books $books)
    {
        return $this->hasFourDifferentBooks($books);
    }

    public function amount(Books $books)
    {
        return 20 / 100 * 4 * Book::PRICE;
    }

    private function hasFourDifferentBooks(Books $books)
    {
        $bookNames = $books->names();

        return count(array_unique($bookNames)) == 4;
    }
}