<?php

namespace App\Handlers;

class Utf8ToUnicodeHandler
{
    public function process($str)
    {
        return trim(json_encode($str), '"');
    }
}