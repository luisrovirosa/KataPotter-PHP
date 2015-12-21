<?php

namespace KataPotter;

use KataPotter\Test\Discount;

class TenPercentDiscountOnThreeDifferentBooks implements Discount
{

    public function match($books)
    {
        return count($books) == 3 && $this->hasThreeDifferentBooks($books);
    }

    public function amount($books)
    {
        return 10 / 100 * 3 * Book::PRICE;
    }

    /**
     * @param $books
     * @return bool
     */
    private function hasThreeDifferentBooks($books)
    {
        return $books[0] != $books[1] && $books[1] != $books[2];
    }
}