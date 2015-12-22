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
     * @param GroupsGenerator $groupsGenerator
     */
    public function __construct(array $discounts, GroupsGenerator $groupsGenerator)
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

    /**
     * @param $books
     * @return BookGroup[]
     */
    private function generateGroups($books)
    {
        return $this->groupsGenerator->generate($books);
    }

    /**
     * @param $groupOfBooks
     * @return BookGroup[]
     */
    private function calculateDiscounts($groupOfBooks)
    {
        $discounts = array_map(
            function (BookGroup $bookGroup) {
                return $this->calculateGroupDiscount($bookGroup);
            }, $groupOfBooks
        );

        return $discounts;
    }

    private function calculateGroupDiscount(BookGroup $bookGroup)
    {
        $discounts = array_map(
            function (Books $books) {
                $discount = $this->selectDiscount($books);

                return $discount->amount($books);
            },
            $bookGroup->all()
        );

        return array_sum($discounts);
    }

    private function selectDiscount(Books $books)
    {

        foreach ($this->discounts as $discount) {
            if ($discount->match($books)) {
                return $discount;
            }
        }
        throw new \Exception('No discount available');
    }
}