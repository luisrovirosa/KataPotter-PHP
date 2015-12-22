<?php

namespace KataPotter\Groups;

use KataPotter\Books;
use KataPotter\BooksGroup;

class PrioritizeGroupsOfFourElements implements GroupGeneratorStrategy
{

    /**
     * @param Books $books
     * @return BooksGroup[]
     */
    public function generate(Books $books)
    {
        $tmpBook = $books->duplicate();
        $groupOfBooks = [];
        do {
            $numbers = $tmpBook->names();
            $unique = array_keys(array_unique($numbers));
            $unique = array_slice($unique, 0, 4);

            $groupOfBooks[] = $tmpBook->remove($unique);
        } while ($tmpBook->size() > 0);

        return [new BooksGroup($groupOfBooks)];
    }
}