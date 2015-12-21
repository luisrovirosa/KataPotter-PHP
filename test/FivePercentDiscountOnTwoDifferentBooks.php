<?php

namespace KataPotter\Test;

use KataPotter\Book;

class FivePercentDiscountOnTwoDifferentBooks implements Discount
{
    public function match($books)
    {
        return (count($books) == 2 && $books[0] != $books[1]);
    }

    public function amount($books)
    {
        return 5 / 100 * 2 * Book::PRICE;
    }
}