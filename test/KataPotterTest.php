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
    public function same_book_has_no_discount($bookNumbers)
    {
        $expectedPrice = count($bookNumbers) * 8;
        $this->assertBasketCost($bookNumbers, $expectedPrice);
    }

    public function noDiscountBooks()
    {
        return [
            [[1]],
            [[1, 1]],
            [[1, 1, 1]],
            [[1, 1, 1, 1]],
            [[1, 1, 1, 1, 1]],
            [[2]],
            [[2, 2]],
            [[2, 2, 2]],
            [[2, 2, 2, 2]],
            [[2, 2, 2, 2, 2]],
            [[3]],
            [[3, 3]],
            [[3, 3, 3]],
            [[3, 3, 3, 3]],
            [[3, 3, 3, 3, 3]],
            [[4]],
            [[4, 4]],
            [[4, 4, 4]],
            [[4, 4, 4, 4]],
            [[4, 4, 4, 4, 4]],
            [[5]],
            [[5, 5]],
            [[5, 5, 5]],
            [[5, 5, 5, 2]],
            [[5, 5, 5, 5, 5]],
        ];
    }

    // Two different books has a 5% of discount
    // Three different books has a 10% of discount
    // Four different books has a 20% of discount
    // Five different books has a 25% of discount
    // Three different books and one duplicated get the 20% of discount on the 3 different books
    // 2 copies of first book, 2 copies of second, 2 of the third, 1 of fourth and 1 of the fifth costs 51.2 €

    /**
     * @param $bookNumbers
     * @param $expectedPrice
     */
    private function assertBasketCost($bookNumbers, $expectedPrice)
    {
        $basket = $this->createBasketWithBooks($bookNumbers);
        $message = "The books " . json_encode($bookNumbers) . " should cost $expectedPrice";
        $this->assertEquals($expectedPrice, $basket->price(), $message);
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
}