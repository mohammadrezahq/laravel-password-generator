<?php

namespace Mor\Passgen\Chars;

use Mor\Passgen\App\PasswordGenerator\Char;

class Special extends Char {

    public $characters = [
        '~','`','!','@','#','$','^','&','*','(',')','-','_','=','+','/','{','}','|',':',';','"',"'",'<','>',',','.','?'
    ];

}