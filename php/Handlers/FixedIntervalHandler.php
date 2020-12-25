<?php

namespace App\Handlers;

/**
 * 固定行间空行
 */
class FixedIntervalHandler
{
    public function process($str)
    {
        return preg_replace('/(\n[\n]+)/', "\n\n", $str);
    }
}