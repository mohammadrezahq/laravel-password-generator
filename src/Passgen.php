<?php

namespace Mor\Passgen;

use Mor\Passgen\Handler;

class Passgen extends Handler
{

    /**
     * Generate password static method.
     *
     * @param  Int $length : Length of password
     * @param  Bool $small : Use small letters
     * @param  Bool $capital : Use capital letters
     * @param  Bool $number : Use numbers
     * @param  Bool $special : Use special chars
     * @return String : generated password
     */
    public static function Generate(int $length = 8, bool $small = true, bool $capital = false, bool $number = false, bool $special = false) {

        $array = [];

        if ( $small ) $array = array_merge($array, self::SMALL_LETTERS);

        if ( $capital ) $array = array_merge($array, self::CAPITAL_LETTERS);

        if ( $number ) $array = array_merge($array, self::NUMBERS);

        if ( $special ) $array = array_merge($array, self::SPECIALS);

        $pass = (new Self)->handleOrder($array, $length);

        return $pass;

    }

    /**
     * Use small letter in password.
     *
     * @param  Int $count
     * @return this
     */
    public function small(Int $count = 0, Bool $exact = false) {

        if ($count !== 0) {

            $this->count['small']['count'] = $count;
            $this->count['small']['exact'] = $exact;

        }

        $this->final = array_merge($this->final, self::SMALL_LETTERS);

        return $this;

    }

    /**
     * Use capital letter in password.
     *
     * @param  Int $count
     * @return this
     */
    public function capital(Int $count = 0, Bool $exact = false) {

        if ($count !== 0) {

            $this->count['capital']['count'] = $count;
            $this->count['capital']['exact'] = $exact;

        }


        $this->final = array_merge($this->final, self::CAPITAL_LETTERS);

        return $this;

    }

    /**
     * Use number in password.
     *
     * @param  Int $count
     * @return this
     */
    public function number(Int $count = 0, Bool $exact = false) {

        if ($count !== 0) {

            $this->count['number']['count'] = $count;
            $this->count['number']['exact'] = $exact;

        }

        $this->final = array_merge($this->final, self::NUMBERS);

        return $this;

    }

    /**
     * Use special chars in password.
     *
     * @param  Int $count
     * @return this
     */
    public function special(Int $count = 0, Bool $exact = false) {

        if ($count !== 0) {

            $this->count['special']['count'] = $count;
            $this->count['special']['exact'] = $exact;

        }

        $this->final = array_merge($this->final, self::SPECIALS);

        return $this;

    }

    /**
     * Chars that should contain in password.
     *
     * @param  Array|String $value
     * @return this
     */
    public function contain($value) {

        if (is_array($value)) {

            $this->contains = $value;

        } else {

            $this->contains = str_split($value);

        }

        return $this;

    }

    /**
     * Chars that should not contain in password.
     *
     * @param  Array|String $value
     * @return this
     */
    public function notContain($value) {

        if (is_array($value)) {

            $this->notContain = $value;

        } else {

            $this->notContain = str_split($value);

        }

        return $this;

    }

    /**
     * Generate pass.
     *
     * @param  Int $length : Password length
     * @return String Password
     */
    public function make(Int $length = 0) {

        $this->length = $length;

        if ($this->notContain) {

            $this->final = array_diff($this->final, $this->notContain);

        }

        return $this->handleOrder($length);

    }

    /**
     * Re order string static method.
     *
     * @param  String $string
     * @return String : re-ordered string
     */
    public static function reOrder( string $string ) {

        $array = str_split($string);
        return (new self)->handleOrder($array, count($array));

    }

    public function stringToPass(String $string, Bool $shuffle = false) {


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

    /*
    toMagic method: Still does not completed.
    public function toMagic() {

        $string = $this->string;
        $array = str_split($string);
        $newArray = [];
        foreach($array as $char) {
            if (isset(self::MAGIC_CHARS[strtolower($char)])) {
                array_push($newArray, self::MAGIC_CHARS[strtolower($char)]);
            } else {
                array_push($newArray, $char);
            }
        }

        $string = '';

        for($i = 0; $i < count($newArray); $i++) {
            $string .= $newArray[$i];
        }

        $this->string = $string;

        return $this;

    }
    */

    public function with(int $length = 8, string $type = 'begin', bool $small = true, bool $capital = false, bool $number = false, bool $special = false) {

        $array = [];

        $this->length = $length;

        if ( $small ) $array = array_merge($array, self::SMALL_LETTERS);

        if ( $capital ) $array = array_merge($array, self::CAPITAL_LETTERS);

        if ( $number ) $array = array_merge($array, self::NUMBERS);

        if ( $special ) $array = array_merge($array, self::SPECIALS);

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

    public function get() {

        return $this->string;

    }
}
