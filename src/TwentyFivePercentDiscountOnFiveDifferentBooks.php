<?php

namespace KataPotter;

use KataPotter\Test\Discount;

class TwentyFivePercentDiscountOnFiveDifferentBooks implements Discount
{

    public function match(Books $books)
    {
        return $this->hasFiveDifferentBooks($books);
    }

    public function amount(Books $books)
    {
        return 25 / 100 * 5 * Book::PRICE;
    }

    private function hasFiveDifferentBooks(Books $books)
    {
        $bookNames = $books->names();

        return count(array_unique($bookNames)) == 5;
    }
}