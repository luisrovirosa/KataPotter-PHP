<?php

namespace KataPotter;

use KataPotter\Test\Discount;

class TenPercentDiscountOnThreeDifferentBooks implements Discount
{

    public function match(Books $books)
    {
        return $this->hasThreeDifferentBooks($books);
    }

    public function amount(Books $books)
    {
        return 10 / 100 * 3 * Book::PRICE;
    }

    /**
     * @param $books
     * @return bool
     */
    private function hasThreeDifferentBooks(Books $books)
    {
        $bookNames = $books->names();

        return count(array_unique($bookNames)) == 3;
    }
}