<?php

namespace Mor\Passgen\App;

// Load App
use Mor\Passgen\App\PasswordGenerator;
use Mor\Passgen\App\StringToPass;

// Load Extras 
use Mor\Passgen\Extras\ReOrder;

class App {
    
    use PasswordGenerator, StringToPass, ReOrder;

}