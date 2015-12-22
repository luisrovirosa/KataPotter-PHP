<?php

namespace KataPotter;

class Books
{
    private $names;
    /** @var Book[] */
    private $books;

    /**
     * Books constructor.
     * @param Book[] $books
     */
    public function __construct(array $books)
    {
        $this->assertAllElementsAreBooks($books);
        $this->books = $books;
        $this->names = $this->generateNames($books);
    }

    public function size()
    {
        return count($this->books);
    }

    public function names()
    {
        return $this->names;
    }

    /**
     * @param array $books
     * @throws \Exception
     */
    private function assertAllElementsAreBooks(array $books)
    {
        foreach ($books as $book) {
            if (!($book instanceof Book)) {
                throw new \Exception('Not a valid type');
            }
        }
    }

    /**
     * @param Book[] $books
     * @return array
     */
    private function generateNames($books)
    {
        return array_map(
            function (Book $book) {
                return $book->name();
            }, $books
        );
    }

}