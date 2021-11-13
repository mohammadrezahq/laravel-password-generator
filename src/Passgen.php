<?php

namespace Mor\Passgen;

use Mor\Passgen\Handler;

class Passgen extends Handler
{

    /**
     * Generate password static method.
     *
     * @param  int $length : Length of password
     * @param  bool $small : Use small letters
     * @param  bool $capital : Use capital letters
     * @param  bool $number : Use numbers
     * @param  bool $special : Use special chars
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
     * @param  int $count
     * @return this
     */
    public function small(Int $count = 0) {

        if ($count == 0) {

            $this->final = array_merge($this->final, self::SMALL_LETTERS);

            return $this;

        }

    }

    /**
     * Use capital letter in password.
     *
     * @param  int $count
     * @return this
     */
    public function capital(Int $count = 0) {

        if ($count == 0) {

            $this->final = array_merge($this->final, self::CAPITAL_LETTERS);

            return $this;

        }

    }

    /**
     * Use number in password.
     *
     * @param  int $count
     * @return this
     */
    public function number(Int $count = 0) {

        if ($count == 0) {

            $this->final = array_merge($this->final, self::NUMBERS);

            return $this;

        }

    }

    /**
     * Use special chars in password.
     *
     * @param  int $count
     * @return this
     */
    public function special(Int $count = 0) {

        if ($count == 0) {

            $this->final = array_merge($this->final, self::SPECIALS);

            return $this;

        }

    }

    /**
     * Chars that should contain in password.
     *
     * @param  array|string $value
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
     * @param  array|string $value
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
     * @param  int $length : Password length 
     * @return string Password
     */
    public function make(Int $length) {

        $this->length = $length;

        if ($this->notContain) {

            $this->final = array_diff($this->final, $this->notContain);

        }

        if ($this->contains) {

            return $this->containOrder($this->final, $length);

        }

        return $this->handleOrder($this->final, $length);

    }

    /**
     * Re order string static method.
     *
     * @param  string $string
     * @return String : re-ordered string
     */
    public static function reOrder( string $string ) {

        $array = str_split($string);
        return (new self)->handleOrder($array, count($array));

    }
}
