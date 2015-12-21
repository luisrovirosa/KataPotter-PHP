<?php

namespace KataPotter\Test;

use KataPotter\Book;

class FivePercentDiscountOnTwoDifferentBooks implements Discount
{
    public function match($books)
    {
        return $this->hasTwoDifferentBooks($books);
    }

    public function amount($books)
    {
        return 5 / 100 * 2 * Book::PRICE;
    }

    private function hasTwoDifferentBooks($books)
    {
        $bookNames = array_map(
            function (Book $book) {
                return $book->name();
            }, $books
        );

        return count(array_unique($bookNames)) == 2;
    }
}