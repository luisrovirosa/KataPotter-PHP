<?php

namespace KataPotter;

use KataPotter\Test\Discount;

class TwentyPercentDiscountOnFourDifferentBooks implements Discount
{

    public function match($books)
    {
        return count($books) == 4 && $this->hasFourDifferentBooks($books);
    }

    public function amount($books)
    {
        return 20 / 100 * 4 * Book::PRICE;
    }

    private function hasFourDifferentBooks($books)
    {
        return $books[0] != $books[1] && $books[1] != $books[2] && $books[2] != $books[3];
    }
}