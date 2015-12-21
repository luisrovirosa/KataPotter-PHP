<?php

namespace KataPotter\Test;

use KataPotter\Basket;
use KataPotter\Book;

class KataPotterShould extends \PHPUnit_Framework_TestCase
{

    // One book costs 8 €
    /** @test */
    public function one_book_costs_8_euros()
    {
        $book = new Book(1);
        $basket = new Basket([$book]);
        $this->assertEquals(8, $basket->price());
    }
    // Two copies of the same book costs 16 €
    // Three copies of the same book costs 24 €
    // Four copies of the same book costs 32 €
    // Five copies of the same book costs 40 €
    // Two different books has a 5% of discount
    // Three different books has a 10% of discount
    // Four different books has a 20% of discount
    // Five different books has a 25% of discount
    // Three different books and one duplicated get the 20% of discount on the 3 different books
    // 2 copies of first book, 2 copies of second, 2 of the third, 1 of fourth and 1 of the fifth costs 51.2 €
}