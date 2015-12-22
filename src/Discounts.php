<?php

namespace KataPotter;

use KataPotter\Discounts\Discount;

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
        $groups = $this->generateGroups($books);
        $discounts = $this->calculateDiscountOfEachGroup($groups);

        return max($discounts);
    }

    public function selectDiscount(Books $books)
    {
        foreach ($this->discounts as $discount) {
            if ($discount->match($books)) {
                return $discount;
            }
        }
        throw new \Exception('No discount available');
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
    private function calculateDiscountOfEachGroup($groupOfBooks)
    {
        $discounts = array_map(
            function (BooksGroup $bookGroup) {
                return $bookGroup->calculateDiscount($this);
            }, $groupOfBooks
        );

        return $discounts;
    }
}