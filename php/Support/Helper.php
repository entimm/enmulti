<?php

namespace App\Support;

class Helper
{
    public static function utf8Strrev($str)
    {
        preg_match_all('/./us', $str, $ar);

        return implode(array_reverse($ar[0]));
    }
}