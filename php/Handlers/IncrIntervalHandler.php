<?php

namespace App\Handlers;

/**
 * 加大空行
 */
class IncrIntervalHandler
{
    public function process($str)
    {
        return preg_replace('/(\n[\n]+)/', '${1}'.PHP_EOL, $str);
    }
}