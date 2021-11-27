<?php

namespace Mor\Passgen\App\PasswordGenerator;

// Load Characters
use Mor\Passgen\Chars\Small;
use Mor\Passgen\Chars\Number;
use Mor\Passgen\Chars\Capital;
use Mor\Passgen\Chars\Special;

trait Bootstrap
{
    /**
     * Load Characters
     */
    public function __construct()
    {
        $this->registerChars([
            Small::class,
            Number::class,
            Capital::class,
            Special::class
        ]);
    }

}
