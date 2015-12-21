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
        return $this->calculateBestDiscount($books);
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

    private function calculateBestDiscount($books)
    {
        $groups = $this->generateGroups($books);
        $discounts = array_map(
            function ($group) {
                return $this->calculateGroupDiscount($group);
            }, $groups
        );

        return max($discounts);
    }

    private function calculateGroupDiscount($group)
    {
        $discounts = array_map(
            function ($books) {
                $discount = $this->selectDiscount($books);

                return $discount->amount($books);
            },
            $group
        );

        return array_sum($discounts);
    }

    private function generateGroups($books)
    {
        // FIXME: Not done
        $groups = [
            [$books],
        ];

        return $groups;
    }
}