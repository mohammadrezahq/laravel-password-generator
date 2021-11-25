<?php

namespace Mor\Passgen;

// Load Handler
use Mor\Passgen\Inc\Handler;

// Load App
use Mor\Passgen\App\PasswordGenerator;
use Mor\Passgen\App\StringToPass;

// Load Extras 
use Mor\Passgen\Extras\ReOrder;

final class Passgen extends Handler
{

    use PasswordGenerator, StringToPass, ReOrder;

}
