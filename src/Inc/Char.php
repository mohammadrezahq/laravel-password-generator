<?php

namespace Mor\Passgen\Inc;

abstract class Char {

    public $characters;
    public $count;
    public $exact;

    public function __construct($count = 0, $exact = false)
    {
        $this->count = $count;
        $this->exact = $exact;
    }
}