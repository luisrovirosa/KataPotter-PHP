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

        $max = max($discounts);

        return $max;
    }

    /**
     * @param $books
     * @return BooksGroup[]
     */
    private function generateGroups($books)
    {
        return $this->groupsGenerator->generate($books);
    }

    /**
     * @param $groupOfBooks
     * @return BooksGroup[]
     */
    private function calculateDiscounts($groupOfBooks)
    {
        $discounts = array_map(
            function (BooksGroup $bookGroup) {
                return $this->calculateGroupDiscount($bookGroup);
            }, $groupOfBooks
        );

        return $discounts;
    }

    private function calculateGroupDiscount(BooksGroup $bookGroup)
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