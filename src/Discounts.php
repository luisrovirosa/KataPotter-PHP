<?php

namespace KataPotter;

use KataPotter\Test\Discount;

class Discounts
{
    /** @var Discount[] */
    private $discounts;

    /**
     * Discounts constructor.
     * @param Discount[] $discounts
     */
    public function __construct($discounts)
    {
        $this->discounts = $discounts;
    }

    public function calculate($books)
    {
        $discount = $this->selectDiscount($books);

        return $discount->amount($books);
    }

    private function selectDiscount($books)
    {
        foreach ($this->discounts as $discount) {
            if ($discount->match($books)) {
                return $discount;
            }
        }
        throw new \Exception('No discount available');
    }
}