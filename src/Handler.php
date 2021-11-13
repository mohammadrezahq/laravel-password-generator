<?php

namespace Mor\Passgen;

use Mor\Passgen\Base;

class Handler extends Base {

    protected $smalls;
    protected $capitals;
    protected $numbers;
    protected $specials;
    protected $counts;
    protected $contains;
    protected $notContain;
    protected $final = [];

    protected function handleOrder($array, $length) {

        shuffle( $array );

        $array = array_values($array);

        $pass = '';

        for ($i = 0; $i < $length; $i++) {
            $pass .= $array[rand(0, count($array) - 1)];
        }

        return $pass;
    }


    protected function containOrder($array, $length) {

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
