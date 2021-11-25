<?php

namespace Mor\Passgen\Inc;

class Base
{
    protected $registeredChars = [];

    protected function registerChars(array $classnames) {

        foreach ($classnames as $classname) {

            if (!in_array($classname, $this->registeredChars)) {

                array_push($this->registeredChars, $classname);
    
            }

        }

    }

    protected function getType(String $item) {

        foreach($this->registeredChars as $chars) {
            if (in_array($item, (new $chars())->characters)) return $chars;
        }

        return 'unknown';
    }

    /*

    Magic Chars:  Is not completed.
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
}
