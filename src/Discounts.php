<?php

namespace KataPotter;

class Discounts
{

    public function calculate($books)
    {
        $discount = 0;
        if (count($books) == 2 && $books[0] != $books[1]) {
            $discount = 5 / 100;
        }

        return $discount * count($books) * Book::PRICE;
    }
}