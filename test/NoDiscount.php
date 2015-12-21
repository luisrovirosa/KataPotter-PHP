<?php

namespace KataPotter\Test;

class NoDiscount implements Discount
{

    public function match($books)
    {
        return true;
    }

    public function amount($books)
    {
        return 0;
    }
}