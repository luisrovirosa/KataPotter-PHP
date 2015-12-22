<?php

namespace KataPotter;

use KataPotter\Test\Discount;

class Discounts
{
    /** @var Discount[] */
    private $discounts;
    /**
     * @var GroupsGenerator
     */
    private $groupsGenerator;

    /**
     * Discounts constructor.
     * @param Discount[] $discounts
     */
    public function __construct($discounts, GroupsGenerator $groupsGenerator)
    {
        $this->discounts = $discounts;
        $this->groupsGenerator = $groupsGenerator;
    }

    public function calculate($books)
    {
        return $this->calculateBestDiscount($books);
    }

    private function calculateBestDiscount($books)
    {
        $groups = $this->generateGroups($books);
        $discounts = $this->calculateDiscounts($groups);

        return max($discounts);
    }

    private function generateGroups($books)
    {
        return $this->groupsGenerator->generate($books);
    }

    /**
     * @param $groups
     * @return array
     */
    private function calculateDiscounts($groups)
    {
        $discounts = array_map(
            function ($group) {
                return $this->calculateGroupDiscount($group);
            }, $groups
        );

        return $discounts;
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