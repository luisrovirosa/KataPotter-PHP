<?php

namespace KataPotter;

class Book
{
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