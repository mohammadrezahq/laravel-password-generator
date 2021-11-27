<?php

namespace Mor\Passgen\App\PasswordGenerator;

use Mor\Passgen\App\PasswordGenerator\Bootstrap;

trait Handler
{

    use Bootstrap;
    
    /**
     * Registered Characters
     */
    protected $registeredChars = [];

    protected function registerChars(array $classnames) {

        foreach ($classnames as $classname) {

            if (!in_array($classname, $this->registeredChars)) {

                array_push($this->registeredChars, $classname);
    
            }

        }

    }

    public function __call($method, $params) {

        foreach ($this->registeredChars as $char) {
            
            if ($method == (new $char())->name) {

                $this->setChar(new $char($params[0], $params[1]));
                return $this;

            }

        }

        die("Method does not exist.");

    }  

    protected function isCharRegistered( string $character ) {

        foreach ($this->registeredChars as $char) {
            
            if ($character == (new $char())->name) {

                return (new $char())->characters;

            }

        }

        return false;

    }


}
