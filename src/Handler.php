<?php

namespace Mor\Passgen;

use Mor\Passgen\Base;

class Handler extends Base
{

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
     * Contain charecters
     */
    protected $contains;

    /**
     * Not contain charecters
     */
    protected $notContain;
    
    /**
     * Final resault
     */
    protected $final = [];

    /**
     * Handle order of given array.
     *
     * @param  array $array : array of characters
     * @param  int $length : length of password
     * @return String : generated password
     */
    protected function handleOrder(array $array, $length)
    {

        shuffle($array);

        $array = array_values($array);

        $pass = '';

        for ($i = 0; $i < $length; $i++) {
            $pass .= $array[rand(0, count($array) - 1)];
        }

        return $pass;
    }

    /**
     * Handle order of given array with contain method.
     *
     * @param  array $array : array of characters
     * @param  int $length : length of password
     * @return String : generated password
     */
    protected function containOrder($array, $length)
    {

        $charactersWithoutContain = array_diff($array, $this->contains);

        $charactersWithoutContain = array_values($charactersWithoutContain);

        $contains = $this->contains;
        $containsLength = count($contains);

        $passLength = $length - $containsLength;

        $newArray = [];

        $a = 0;
        while ($a < $containsLength) {
            array_push($newArray, $contains[$a]);
            $a++;
        }

        $b = 0;
        while ($b < $passLength) {
            array_push($newArray, $charactersWithoutContain[rand(0, count($charactersWithoutContain) - 1)]);
            $b++;
        }

        shuffle($newArray);

        $pass = '';

        for ($i = 0; $i < $length; $i++) {
            $pass .= $newArray[$i];
        }

        return $pass;
    }
}
