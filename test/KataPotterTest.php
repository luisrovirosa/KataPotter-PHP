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

    /**
     * @dataProvider twoDifferentBooksHasA5PercentDiscount
     * @test
     */
    public function two_different_books_has_a_5_percent_of_discount($bookNumbers)
    {
        $this->assertBasketCost($bookNumbers, 2 * 8 * 0.95);
    }

    public function twoDifferentBooksHasA5PercentDiscount()
    {
        return [
            [[1, 2]],
            [[1, 3]],
            [[1, 4]],
            [[1, 5]],
            [[2, 1]],
            [[2, 3]],
            [[2, 4]],
            [[2, 5]],
            [[3, 1]],
            [[3, 2]],
            [[3, 4]],
            [[3, 5]],
            [[4, 1]],
            [[4, 2]],
            [[4, 3]],
            [[4, 5]],
            [[5, 1]],
            [[5, 2]],
            [[5, 3]],
            [[5, 4]],
        ];
    }

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