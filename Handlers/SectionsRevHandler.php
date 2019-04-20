<?php

namespace App\Handlers;

class SectionsRevHandler
{
    public function process($str, $sections, $key)
    {
        $count = count($sections);

        return $sections[$count -$key - 1];
    }
}