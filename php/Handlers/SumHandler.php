<?php

namespace App\Handlers;

/**
 * 数字加
 */
class SumHandler
{
    public function process($str)
    {
        $arr = explode(PHP_EOL, $str);

        return array_sum($arr);
    }
}