<?php

namespace KataPotter;

use KataPotter\Test\Discount;

class TwentyFivePercentDiscountOnFiveDifferentBooks implements Discount
{

    public function match($books)
    {
        return count($books) == 5 && $this->hasFiveDifferentBooks($books);
    }

    public function amount($books)
    {
        return 25 / 100 * 5 * Book::PRICE;
    }

    private function hasFiveDifferentBooks($books)
    {
        $bookNames = array_map(
            function (Book $book) {
                return $book->name();
            }, $books
        );

        return count(array_unique($bookNames)) == 5;
    }
}