<?php

namespace App\Classes\Inspections;

class InvalidWord
{
    protected $keywords = [
        'yahoo customer support',
        'pussy',
        'fuck',
        'Iran'

    ];


    public function detect($body)
    {
        foreach ($this->keywords as $keyword) {
            if (stripos($body, $keyword) !== false) {
                throw new \Exception('Invalid Word Error!!!');
            }
        }
    }
}

