<?php

namespace KataPotter\Test;

use KataPotter\Basket;
use KataPotter\Book;
use KataPotter\Books;
use KataPotter\Discounts;
use KataPotter\Discounts\FivePercentDiscountOnTwoDifferentBooks;
use KataPotter\Discounts\NoDiscount;
use KataPotter\Discounts\TenPercentDiscountOnThreeDifferentBooks;
use KataPotter\Discounts\TwentyFivePercentDiscountOnFiveDifferentBooks;
use KataPotter\Discounts\TwentyPercentDiscountOnFourDifferentBooks;
use KataPotter\GroupsGenerator;

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

    /**
     * @dataProvider differentAndSameBooks
     * @test
     */
    public function different_books_and_one_duplicated_get_the_discount_on_the_different_books(
        $bookNumbers, $discount
    ) {
        $expectedPrice = (8 * (count($bookNumbers) - 1) * $discount) + 8;
        $this->assertBasketCost($bookNumbers, $expectedPrice);
    }

    public function differentAndSameBooks()
    {
        return [
            [[1, 2, 2], .95],
            [[1, 2, 3, 3], .9],
            [[1, 2, 3, 4, 4], .8],
        ];
    }

    /** @test */
    public function several_discounts()
    {
        $this->assertBasketCost([1, 1, 2, 2], 2 * 2 * 8 * .95);
    }

    /** @test */
    public function two_discounts_of_four_books_are_better_than_one_of_five_and_another_of_three()
    {
        $this->assertBasketCost([1, 1, 2, 2, 3, 3, 4, 5], 2 * (8 * 4 * 0.8));
    }

    /** @test */
    public function crazy_test_case()
    {
        $this->markTestIncomplete('It\'s necessary better group generator for this one');
        $bookNumbers = array_merge(
            array_fill(0, 5, 1),
            array_fill(0, 5, 2),
            array_fill(0, 4, 3),
            array_fill(0, 5, 4),
            array_fill(0, 4, 5)
        );
        $this->assertBasketCost(
            $bookNumbers,
            3 * (8 * 5 * 0.75) + 2 * (8 * 4 * 0.8)
        );
    }

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
                ],
                new GroupsGenerator()
            )
        );
    }

    /**
     * @param array $bookNumbers
     * @return Books
     */
    private function books(array $bookNumbers)
    {
        $books = [];
        foreach ($bookNumbers as $number) {
            $books[] = new Book($number);
        }

        return new Books($books);
    }
}