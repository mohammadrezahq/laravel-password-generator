<?php

namespace Mor\Passgen\App\PasswordGenerator;

abstract class Char {

    public $name = '';

    public $characters;

    public $count;

    public $exact;

    public function __construct($count = 0, $exact = false)
    {
        $this->count = $count;
        $this->exact = $exact;

        if ($this->name == '') {
            $path = explode('\\', get_class($this) );
            $this->name = strtolower(array_pop($path));
        }

    }
}