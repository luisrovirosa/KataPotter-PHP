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
        $this->generateNames();
    }

    public function size()
    {
        return count($this->books);
    }

    public function names()
    {
        return $this->names;
    }

    public function remove($indexes)
    {
        $books = array_map(
            function ($index) {
                $book = $this->books[$index];
                unset($this->books[$index]);

                return $book;
            }, $indexes
        );

        $this->updateInternalData();

        return new Books($books);
    }

    public function duplicate()
    {
        return new Books($this->books);
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
     * @return array
     */
    private function generateNames()
    {
        $this->names = array_map(
            function (Book $book) {
                return $book->name();
            }, $this->books
        );
    }

    private function updateInternalData()
    {
        $this->books = array_values($this->books);
        $this->generateNames();
    }

}