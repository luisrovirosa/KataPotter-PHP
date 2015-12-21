<?php

namespace KataPotter;

class Book
{
    const PRICE = 8;
    /** @var string */
    private $name;

    /**
     * Book constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

}