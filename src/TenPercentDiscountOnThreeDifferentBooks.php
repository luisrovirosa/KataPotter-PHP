<?php

namespace KataPotter;

use KataPotter\Test\Discount;

class TenPercentDiscountOnThreeDifferentBooks implements Discount
{

    public function match($books)
    {
        return $this->hasThreeDifferentBooks($books);
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
        $bookNames = array_map(
            function (Book $book) {
                return $book->name();
            }, $books
        );

        return count(array_unique($bookNames)) == 3;
    }
}