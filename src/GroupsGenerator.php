<?php

namespace KataPotter;

class GroupsGenerator
{

    /**
     * @param $books
     * @return BookGroup[]
     */
    public function generate(Books $books)
    {
        // FIXME: Not done
        $groups = [
            new BookGroup(
                [$books]
            ),
        ];

        return $groups;
    }
}