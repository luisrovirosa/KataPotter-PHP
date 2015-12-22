<?php

namespace KataPotter;

class BooksGroup
{
    /**
     * @var Books[]
     */
    private $books;

    /**
     * BookGroup constructor.
     * @param Books[] $books
     */
    public function __construct($books)
    {
        $this->books = $books;
    }

    public function calculateDiscount(Discounts $discounts)
    {
        $discounts = array_map(
            function (Books $books) use ($discounts) {
                $discount = $discounts->selectDiscount($books);

                return $discount->amount($books);
            },
            $this->books
        );

        return array_sum($discounts);
    }

}