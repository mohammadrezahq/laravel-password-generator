<?php

namespace Mor\Passgen\App;

// Load Characters
use Mor\Passgen\Chars\Small;
use Mor\Passgen\Chars\Number;
use Mor\Passgen\Chars\Capital;
use Mor\Passgen\Chars\Special;

trait PasswordGenerator {

    public function __construct()
    {
        // Register Characters
        $this->registerChars([
            Small::class,
            Number::class,
            Capital::class,
            Special::class
        ]);
    }

    
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
    public static function Generate(int $length = 8, bool $small = true, bool $capital = false, bool $number = false, bool $special = false) 
    {
        $array = [];

        if ( $small ) $array = array_merge($array, (new Small())->characters);

        if ( $capital ) $array = array_merge($array, (new Capital())->characters);

        if ( $number ) $array = array_merge($array, (new Number())->characters);

        if ( $special ) $array = array_merge($array, (new Special())->characters);

        shuffle($array);

        $pass = '';


        for ($i = 0; $i < $length; $i++) {
            $pass .= $array[rand(0, count($array) - 1)];
        }

        return $pass;
    }
    
    /**
     * Use small letter in password.
     *
     * @param  Int $count
     * @return this
     */
    public function small(Int $count = 0, Bool $exact = false) 
    {
        $this->setChar(new Small($count, $exact));
        return $this;
    }

    /**
     * Use capital letter in password.
     *
     * @param  Int $count
     * @return this
     */
    public function capital(Int $count = 0, Bool $exact = false) 
    {
        $this->setChar(new Capital($count, $exact));
        return $this;
    }

    /**
     * Use number in password.
     *
     * @param  Int $count
     * @return this
     */
    public function number(Int $count = 0, Bool $exact = false)
    {
        $this->setChar(new Number($count, $exact));
        return $this;
    }

    /**
     * Use special chars in password.
     *
     * @param  Int $count
     * @return this
     */
    public function special(Int $count = 0, Bool $exact = false) 
    {
        $this->setChar(new Special($count, $exact));
        return $this;
    }

    /**
     * Chars that should contain in password.
     *
     * @param  Array|String $value
     * @return this
     */
    public function contain($value) 
    {
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
    public function notContain($value)
    {
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
    public function make(Int $length = 0) 
    {
        $this->length = $length;

        if ($this->notContain) {

            $this->final = array_diff($this->final, $this->notContain);

        }

        return $this->handleOrder($length);
    }

    protected function setChar( Object $object ) 
    {
        $this->final = array_merge($this->final, $object->characters);
        if ($object->count !== 0) {
            $this->count[$object::class]['count'] = $object->count;
            $this->count[$object::class]['exact'] = $object->exact;
        }
    }
}