<?php

namespace App\Handlers;

/**
 * duplicate
 */
class DuplicateHandler
{
    public function process($str)
    {
        return $str.PHP_EOL.$str;
    }
}