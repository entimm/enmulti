<?php

namespace App\Handlers;

class RangeHandler
{
    public function process($str, $sections, $key)
    {
        return implode(PHP_EOL, array_fill(0, (int)$str, '###'));
    }
}