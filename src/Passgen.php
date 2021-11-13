<?php

namespace Mor\Passgen;

class Passgen 
{
    protected $smalls = [
        'a','b','c','d','e','f','g','h','j','k','l','n','m','o','p','q','r','s','t','x','y','z'
    ];    
    
    protected $capitals = [
        'A','B','C','D','E','F','G','H','J','K','L','N','M','O','P','Q','R','S','T','X','Y','Z'
    ];    
    
    protected $numbers = [
        '0','1','2','3','4','5','6','7','8','9'
    ];

    protected $specials = [
        '~','`','!','@','#','$','^','&','*','(',')','-','_','=','+','/','{','}','|',':',';','"',"'",'<','>',',','.','?'
    ];



    public function generate(int $length = 8, bool $small = true, bool $capital = false, bool $number = false, bool $special = false) {
        
        $array = [];

        if ( $small ) $array = array_merge($array, $this->smalls);

        if ( $capital ) $array = array_merge($array, $this->capitals);

        if ( $number ) $array = array_merge($array, $this->numbers);

        if ( $special ) $array = array_merge($array, $this->specials);

        $pass = $this->handleOrder($array, $length);

        return $pass;

    }

    protected function handleOrder($array, $length) {

        shuffle( $array );

        $pass = '';

        for ($i = 0; $i < $length; $i++) {
            $pass .= $array[rand(0, count($array) - 1)];
        }

        return $pass;
    }

    public function reOrder( string $string ) {

        $array = str_split($string);
        return $this->handleOrder($array, count($array));

    }
}