<?php

namespace Mor\Passgen\App;

// Load Handler 
use Mor\Passgen\App\PasswordGenerator\Handler;

trait PasswordGenerator {

    use Handler;
    
   
    /**
     * Count of characters
     */
    protected $count;

    /**
     * Contain charecters
     */
    protected $contains;

    /**
     * Not contain charecters
     */
    protected $notContain;

    /**
     * Final result
     */
    protected $final = [];

    
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
    public static function Generate(int $length = 8, array $characters) 
    {
        $array = [];


        foreach ($characters as $char) {
            $c = (new Self)->isCharRegistered($char);
            if ( $c ) {
                $array = array_merge($array, $c);
            }
        }

        shuffle($array);

        $pass = '';


        for ($i = 0; $i < $length; $i++) {
            $pass .= $array[rand(0, count($array) - 1)];
        }

        return $pass;
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

    
    /**
     * Handle order of given array.
     *
     * @return String : generated password
     */
    protected function handleOrder()
    {
        $this->doNotContain();

        $array = $this->final;

        $length = $this->length;

        $remain = $length;

        $newArray = [];


        if ($this->contains) {

            $array = array_diff($array, $this->contains);
            $array = array_values($array);

            $contains = $this->contains;

            $containsLength = count($contains);

            $remain = $length - $containsLength;

            $newArray = [];

            $a = 0;
            while ($a < $containsLength) {
                $typeOfItem = $this->getType($contains[$a]);
                if (isset($this->count[$typeOfItem])) {
                    $this->count[$typeOfItem]['count']--;
                }
                array_push($newArray, $contains[$a]);
                $a++;
            }

            if ($length == 0) {
                $length = $containsLength;
            }

        }


        if ($length == 0 ) {

            $lenthIsZero = true;

        } else {

            $lenthIsZero = false;

        }


        if ($this->count) {

            foreach($this->count as $key => $value) {

                $characters = (new $key())->characters;
                $count = $value['count'];
                $exact = $value['exact'];

                ${$key . 'Characters'} = [];

                for ($i = 0; $i < $count; $i++) {
                    array_push( ${$key . 'Characters'} , $characters[rand(0, count($characters) - 1)]);
                }

                if ($exact) {

                    $array = array_diff($array, $characters);

                }

                $array = array_diff($array, ${$key . 'Characters'});

                $newArray = array_merge($newArray, ${$key . 'Characters'});


                if ($lenthIsZero) {
                    $length += $count;
                } else {
                    $remain -= $count;
                }

            }

        }


        if ($remain < 0 && $lenthIsZero == false) {
            return "Increase length or decrease counts.";
        }

        $array = array_values($array);

        for ($i = 0; $i < $remain; $i++) {
            array_push( $newArray, $array[rand(0, count($array) - 1)]);
        }


        $newArray = array_values($newArray);

        shuffle($newArray);

        $pass = '';


        for ($i = 0; $i < $length; $i++) {
            $pass .= $newArray[$i];
        }

        return $pass;
    }

    protected function doNotContain() {

        if ($this->notContain) {

            $this->final = array_diff($this->final , $this->notContain);
            $this->final = array_values($this->final);

        }

    }

    protected function getType(String $item) {

        foreach($this->registeredChars as $chars) {
            if (in_array($item, (new $chars())->characters)) return $chars;
        }

        return 'unknown';
    }
}