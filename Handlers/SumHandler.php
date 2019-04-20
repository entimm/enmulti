<?php

namespace App\Handlers;

class SumHandler
{
    public function process($str)
    {
        $arr = explode(PHP_EOL, $str);

        return array_sum($arr);
    }
}