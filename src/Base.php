<?php

namespace Mor\Passgen;

class Base
{

    const SMALL_LETTERS = [
        'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','x','y','z'
    ];

    const CAPITAL_LETTERS = [
        'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','X','Y','Z'
    ];

    const NUMBERS = [
        '0','1','2','3','4','5','6','7','8','9'
    ];

    const SPECIALS = [
        '~','`','!','@','#','$','^','&','*','(',')','-','_','=','+','/','{','}','|',':',';','"',"'",'<','>',',','.','?'
    ];

    /*
    Magic Chars:  Still does not completed.
    const MAGIC_CHARS = [
        'a'=>['@', 'Λ', 'Â', 'ᵃ', '4', '∀'],
        'b'=>['ѣ', 'β', 'Б', '8', 'Ϧ', 'ꉉ', 'Ⓑ'],
        'c'=>['ḉ', '℃', 'ζ', 'Ȼ', '©', 'ɔ'],
        'd'=>['𝕕', 'ⓓ', 'Ԁ', '∂', 'ԃ'],
        'e'=>['@', ],
        'f'=>['@'],
        'g'=>['@'],
        'h'=>['@'],
        'i'=>['@'],
        'j'=>['@'],
        'k'=>['@'],
        'l'=>['@'],
        'm'=>['@'],
        'n'=>['@'],
        'o'=>['@'],
        'p'=>['@'],
        'q'=>['@'],
        'r'=>['@'],
        's'=>['@'],
        't'=>['@'],
        'x'=>['@'],
        'y'=>['@'],
        'z'=>['@'],
    ];
    */

    protected function getType(String $item) {

        if (in_array($item, self::SMALL_LETTERS)) return 'small';
        if (in_array($item, self::CAPITAL_LETTERS)) return 'capital';
        if (in_array($item, self::NUMBERS)) return 'number';
        if (in_array($item, self::SPECIALS)) return 'special';
        return 'unknown';
    }

}
