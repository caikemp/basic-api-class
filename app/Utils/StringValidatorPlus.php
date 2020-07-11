<?php
namespace App\Utils;

use App\Utils\StringValidator;

class StringValidatorPlus extends StringValidator
{
    public function __construct($string) {
        parent::__construct($string);
    }

    public function toString(){
        return 'Plus mega blaster ultra string: ' . parent::cutString(20);
    }
    
}

