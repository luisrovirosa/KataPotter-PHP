<?php
namespace KataPotter\Test;

use KataPotter\Books;

interface Discount
{
    public function match(Books $books);

    public function amount(Books $books);
}