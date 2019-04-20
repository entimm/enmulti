<?php

namespace App\Handlers;

class UnicodeToUtf8Handler
{
    public function process($str)
    {
        return json_decode("\"$str\"");
    }
}