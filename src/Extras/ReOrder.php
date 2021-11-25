<?php

namespace Mor\Passgen\Extras;

trait ReOrder {
    /**
     * Re order string static method.
     *
     * @param  String $string
     * @return String : re-ordered string
     */
    public static function reOrder( string $string ) 
    {
        $array = str_split($string);

        shuffle($array);

        $pass = '';


        for ($i = 0; $i < count($array); $i++) {
            $pass .= $array[$i];
        }

        return $pass;
    }
}
