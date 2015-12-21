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
        return $books[0] != $books[1]
        && $books[1] != $books[2]
        && $books[2] != $books[3]
        && $books[3] != $books[4];
    }
}