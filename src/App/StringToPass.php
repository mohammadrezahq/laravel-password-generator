<?php

namespace Mor\Passgen\App;

// Load Characters
use Mor\Passgen\Chars\Small;
use Mor\Passgen\Chars\Number;
use Mor\Passgen\Chars\Capital;
use Mor\Passgen\Chars\Special;

trait StringToPass {

    /**
     * String to pass variable
     */
    protected $string = '';

    public function stringToPass(String $string, Bool $shuffle = false)
    {
        if ($shuffle) {

            $array = str_split($string);

            $string = '';

            for($i = 0; $i < count($array); $i++) {
                $string .= $array[$i];
            }

        }

        $this->string = $string;

        return $this;
    }


    public function with(int $length = 8, string $type = 'begin', bool $small = true, bool $capital = false, bool $number = false, bool $special = false) 
    {
        $array = [];

        $this->length = $length;

        if ( $small ) $array = array_merge($array, (new Small())->characters);

        if ( $capital ) $array = array_merge($array, (new Capital())->characters);

        if ( $number ) $array = array_merge($array, (new Number())->characters);

        if ( $special ) $array = array_merge($array, (new Special())->characters);

        $this->final = $array;

        $pass = $this->handleOrder($array, $length);

        if ($type == 'before') {
            $this->string = $pass . $this->string;
        }

        if ($type == 'after') {
            $this->string = $this->string . $pass;
        }

        if ($type == 'both') {
            $this->string = $pass . $this->string . $pass;
        }

        return $this;
    }

    public function get() 
    {
        return $this->string;
    }
}