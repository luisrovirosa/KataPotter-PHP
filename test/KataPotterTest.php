<?php

namespace KataPotter\Test;

use KataPotter\Basket;
use KataPotter\Book;

class KataPotterShould extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider noDiscountBooks
     * @test
     */
    public function same_book_has_no_discount($bookNumbers, $expectedPrice)
    {
        $basket = $this->createBasketWithBooks($bookNumbers);
        $this->assertEquals(
            $expectedPrice, $basket->price(),
            "The books " . json_encode($bookNumbers) . " should cost $expectedPrice"
        );
    }

    public function noDiscountBooks()
    {
        return [
            [[1], 8],
            [[1, 1], 16],
            [[1, 1, 1], 24],
            [[1, 1, 1, 1], 32],
            [[1, 1, 1, 1, 1], 40],
            [[2], 8],
            [[2, 2], 16],
            [[2, 2, 2], 24],
            [[2, 2, 2, 2], 32],
            [[2, 2, 2, 2, 2], 40],
            [[3], 8],
            [[3, 3], 16],
            [[3, 3, 3], 24],
            [[3, 3, 3, 3], 32],
            [[3, 3, 3, 3, 3], 40],
            [[4], 8],
            [[4, 4], 16],
            [[4, 4, 4], 24],
            [[4, 4, 4, 4], 32],
            [[4, 4, 4, 4, 4], 40],
            [[5], 8],
            [[5, 5], 16],
            [[5, 5, 5], 24],
            [[5, 5, 5, 2], 32],
            [[5, 5, 5, 5, 5], 40],
        ];
    }

    /**
     * @param $bookNumbers
     * @return Basket
     */
    private function createBasketWithBooks($bookNumbers)
    {
        $books = $this->books($bookNumbers);

        return new Basket($books);
    }

    /**
     * @param array $bookNumbers
     * @return Book[]
     */
    private function books(array $bookNumbers)
    {
        $books = [];
        foreach ($bookNumbers as $number) {
            $books[] = new Book($number);
        }

        return $books;
    }
    // Two different books has a 5% of discount
    // Three different books has a 10% of discount
    // Four different books has a 20% of discount
    // Five different books has a 25% of discount
    // Three different books and one duplicated get the 20% of discount on the 3 different books
    // 2 copies of first book, 2 copies of second, 2 of the third, 1 of fourth and 1 of the fifth costs 51.2 €
}