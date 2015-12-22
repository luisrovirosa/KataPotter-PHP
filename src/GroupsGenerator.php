<?php

namespace KataPotter;

class GroupsGenerator
{

    /**
     * @param $books
     * @return BooksGroup[]
     */
    public function generate(Books $books)
    {
        // FIXME: Not done
        $groups = [
            new BooksGroup([$books]),
            $this->createGroupWithDifferentBooks($books)
        ];

        return $groups;
    }

    /**
     * Create a BookGroup with the maximum amount of different books in each Books.
     * Ex: 1,1,2,2,3,4,5 returns 1,2,3,4,5 and 1,2
     *
     * @param Books $books
     * @return BooksGroup
     */
    private function createGroupWithDifferentBooks(Books $books)
    {
        $tmpBook = $books->duplicate();
        $groupOfBooks = [];
        do {
            $numbers = $tmpBook->names();
            $unique = array_keys(array_unique($numbers));

            $groupOfBooks[] = $tmpBook->remove($unique);
        } while ($tmpBook->size() > 0);

        return new BooksGroup($groupOfBooks);
    }
}