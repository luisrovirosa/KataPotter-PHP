<?php

namespace KataPotter;

use KataPotter\Test\Discount;

class TwentyPercentDiscountOnFourDifferentBooks implements Discount
{

    public function match($books)
    {
        return $this->hasFourDifferentBooks($books);
    }

    public function amount($books)
    {
        return 20 / 100 * 4 * Book::PRICE;
    }

    private function hasFourDifferentBooks($books)
    {
        $bookNames = array_map(
            function (Book $book) {
                return $book->name();
            }, $books
        );

        return count(array_unique($bookNames)) == 4;
    }
}