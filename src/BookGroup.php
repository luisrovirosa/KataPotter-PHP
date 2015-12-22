<?php

namespace KataPotter;

class BookGroup
{
    /**
     * @var Books[]
     */
    private $books;

    /**
     * BookGroup constructor.
     * @param Books[] $books
     */
    public function __construct($books)
    {
        $this->books = $books;
    }

    /**
     * @return Books[]
     */
    public function all()
    {
        return $this->books;
    }
}