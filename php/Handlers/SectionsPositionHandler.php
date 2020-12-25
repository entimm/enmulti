<?php

namespace App\Handlers;

class SectionsPositionHandler
{
    public function process($str, $sections, $key)
    {
        $v = 0;
        for ($i = 0; $i <= $key; $i++) {
            $v += $sections[$i];
        }
        return $v;
    }
}