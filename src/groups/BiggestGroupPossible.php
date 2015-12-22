<?php
namespace KataPotter\Groups;

use KataPotter\Books;
use KataPotter\BooksGroup;

/**
 * Create a BookGroup with the maximum amount of different books in each Books.
 * Ex: 1,1,2,2,3,4,5 returns 1,2,3,4,5 and 1,2
 */
class BiggestGroupPossible implements GroupGeneratorStrategy
{

    public function generate(Books $books)
    {
        $tmpBook = $books->duplicate();
        $groupOfBooks = [];
        do {
            $numbers = $tmpBook->names();
            $unique = array_keys(array_unique($numbers));

            $groupOfBooks[] = $tmpBook->remove($unique);
        } while ($tmpBook->hasBooks());

        return [new BooksGroup($groupOfBooks)];
    }
}