<?php

namespace App\Handlers;

/**
 * implode
 */
class ImplodeHandler
{
    public function process($str)
    {
        $str = preg_replace('/\n/', ',', $str);
        $str = preg_replace('/,{2,}/', PHP_EOL, $str);

        return trim($str, ' ,');
    }
}