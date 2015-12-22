<?php
namespace KataPotter\Groups;

use KataPotter\Books;
use KataPotter\BooksGroup;

interface GroupGeneratorStrategy
{
    /**
     * @param Books $books
     * @return BooksGroup[]
     */
    public function generate(Books $books);
}