<?php
namespace App\Utils;

class StringValidator 
{
    protected $string;

    public function __construct($string) {
        $this->string = $string;
    }

    public function toString() {
        return $this->string;
    }

    public function cutString($length) {
        return substr($this->string, 0, $length);
    }
}
