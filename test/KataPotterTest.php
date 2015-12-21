<?php

namespace KataPotter\Test;

use KataPotter\Basket;
use KataPotter\Book;
use KataPotter\Discounts;
use KataPotter\TenPercentDiscountOnThreeDifferentBooks;
use KataPotter\TwentyFivePercentDiscountOnFiveDifferentBooks;
use KataPotter\TwentyPercentDiscountOnFourDifferentBooks;

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
            [[5, 5, 5, 5]],
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

    /** @test */
    public function three_different_books_has_a_10_percent_of_discount()
    {
        $this->assertBasketCost([1, 2, 3], 3 * 8 * 0.9);
    }

    /** @test */
    public function four_different_books_has_a_20_percent_of_discount()
    {
        $this->assertBasketCost([1, 2, 3, 4], 4 * 8 * 0.8);
    }

    /** @test */
    public function five_different_books_has_a_25_percent_of_discount()
    {
        $this->assertBasketCost([1, 2, 3, 4, 5], 5 * 8 * 0.75);
    }

    /** @test */
    public function three_different_books_and_one_duplicated_get_the_twenty_percent_of_discount_on_the_three_different_books(
    )
    {
        $this->assertBasketCost([1, 2, 3, 3], 3 * 8 * .9 + 8);
    }
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

        return new Basket(
            $books, new Discounts(
                [
                    new TwentyFivePercentDiscountOnFiveDifferentBooks(),
                    new TwentyPercentDiscountOnFourDifferentBooks(),
                    new TenPercentDiscountOnThreeDifferentBooks(),
                    new FivePercentDiscountOnTwoDifferentBooks(),
                    new NoDiscount()
                ]
            )
        );
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