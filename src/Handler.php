<?php

namespace Mor\Passgen;

use Mor\Passgen\Base;

class Handler extends Base
{


    protected $small_characters = self::SMALL_LETTERS;
    protected $capital_characters = self::CAPITAL_LETTERS;
    protected $num_characters = self::NUMBERS;
    protected $special_characters = self::SPECIALS;

    /**
     * Small charecters
     */
    protected $smalls;

    /**
     * Capital charecters
     */
    protected $capitals;

    /**
     * Number charecters
     */
    protected $numbers;

    /**
     * Special charecters
     */
    protected $specials;

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
     * String to pass variable
     */
    protected $string = '';

    /**
     * Handle order of given array.
     *
     * @return String : generated password
     */
    protected function handleOrder()
    {

        $array = $this->final;
        $length = $this->length;
        $newArray = [];

        if ($this->notContain) {

            $this->small_characters = array_diff($this->small_characters, $this->notContain);
            $this->capital_characters = array_diff($this->capital_characters, $this->notContain);
            $this->num_characters = array_diff($this->num_characters, $this->notContain);
            $this->special_characters = array_diff($this->special_characters, $this->notContain);

            $this->small_characters = array_values($this->small_characters);
            $this->capital_characters = array_values($this->capital_characters);
            $this->num_characters = array_values($this->num_characters);
            $this->special_characters = array_values($this->special_characters);

        }

        $remain = $length;

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

                ${$key . 'Characters'} = [];

                for ($i = 0; $i < $value['count']; $i++) {
                    array_push( ${$key . 'Characters'} , $this->{$key . '_characters'}[rand(0, count($this->{$key . '_characters'}) - 1)]);
                }

                if ($value['exact']) {

                    $array = array_diff($array, $this->{$key . '_characters'});

                }

                $array = array_diff($array, ${$key . 'Characters'});

                $newArray = array_merge($newArray, ${$key . 'Characters'});


                if ($lenthIsZero) {
                    $length += $value['count'];
                } else {
                    $remain -= $value['count'];
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
}
