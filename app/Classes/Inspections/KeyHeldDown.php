<?php

namespace App\Classes\Inspections;

class KeyHeldDown
{
    public function detect($body)
    {
        if (preg_match('/(.)\\1{4,}/', $body)) {
            throw new \Exception('Key IS Held Down Error !!!');
        }
    }
}

