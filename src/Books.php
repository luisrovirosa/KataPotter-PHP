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

    public function names()
    {
        return $this->names;
    }

    public function remove($indexes)
    {
        $books = array_map(
            function ($index) {
                return $this->books[$index];
            }, $indexes
        );

        $this->removeBooks($indexes);

        return new Books($books);
    }

    public function price()
    {
        return $this->size() * Book::PRICE;
    }

    public function duplicate()
    {
        return new Books($this->books);
    }

    public function hasBooks()
    {
        return $this->size() > 0;
    }

    private function size()
    {
        return count($this->books);
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

    private function removeBooks($indexes)
    {
        array_map(
            function ($index) {
                unset($this->books[$index]);
            }, $indexes
        );

        $this->books = array_values($this->books);
        $this->generateNames();
    }

}