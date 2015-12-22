<?php

namespace KataPotter;

use KataPotter\Groups\GroupGeneratorStrategy;

class GroupsGenerator
{
    /** @var GroupGeneratorStrategy[] */
    private $strategies;

    /**
     * GroupsGenerator constructor.
     * @param GroupGeneratorStrategy[] $strategies
     */
    public function __construct(array $strategies)
    {
        $this->strategies = $strategies;
    }

    /**
     * @param $books
     * @return BooksGroup[]
     */
    public function generate(Books $books)
    {
        $groups = [];
        foreach ($this->strategies as $strategy) {
            $groups = array_merge($groups, $strategy->generate($books));
        }

        return $groups;
    }

}