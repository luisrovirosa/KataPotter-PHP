<?php
namespace KataPotter\Test;

interface Discount
{
    public function match($books);

    public function amount($books);
}