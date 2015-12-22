<?php

namespace KataPotter\Discounts;

use KataPotter\Books;

class NoDiscount implements Discount
{

    public function match(Books $books)
    {
        return true;
    }

    public function amount(Books $books)
    {
        return 0;
    }
}