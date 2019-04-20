<?php

namespace App\Handlers;

class Utf8StrrevHandler
{
    public function process($str)
    {
        preg_match_all('/./us', $str, $ar);
        
        return implode(array_reverse($ar[0]));
    }
}