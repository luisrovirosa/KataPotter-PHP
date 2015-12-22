<?php

namespace KataPotter;

use KataPotter\Groups\BiggestGroupPossible;
use KataPotter\Groups\GroupGeneratorStrategy;

class GroupsGenerator
{
    /** @var GroupGeneratorStrategy[] */
    private $strategies;

    /**
     * GroupsGenerator constructor.
     * @param GroupGeneratorStrategy[] $strategies
     */
    public function __construct()
    {
        $this->strategies = [
            new BiggestGroupPossible(),
        ];
    }

    /**
     * @param $books
     * @return BooksGroup[]
     */
    public function generate(Books $books)
    {
        // FIXME: Not done
        $groups = [
            $this->createGroupPrioritizingGroupsOfFourElements($books)
        ];
        foreach ($this->strategies as $strategy) {
            $groups = array_merge($groups, $strategy->generate($books));
        }

        return $groups;
    }

    private function createGroupPrioritizingGroupsOfFourElements(Books $books)
    {
        $tmpBook = $books->duplicate();
        $groupOfBooks = [];
        do {
            $numbers = $tmpBook->names();
            $unique = array_keys(array_unique($numbers));
            $unique = array_slice($unique, 0, 4);

            $groupOfBooks[] = $tmpBook->remove($unique);
        } while ($tmpBook->size() > 0);

        return new BooksGroup($groupOfBooks);
    }
}