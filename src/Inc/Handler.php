<?php

namespace Mor\Passgen\Inc;

use Mor\Passgen\Inc\Base;

class Handler extends Base
{
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
}
