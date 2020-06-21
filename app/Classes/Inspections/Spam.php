<?php

namespace App\Classes\Inspections;


class Spam
{
    //an array of inspections that want to run
    protected $inspections = [
        InvalidWord::class,
        KeyHeldDown::class
    ];


    public function detect($body)
    {
        foreach ($this->inspections as  $inspection) {
            app($inspection)->detect($body);
        }

        //if no exception is thrown then there is no spam,return false
        return false;
    }
}

