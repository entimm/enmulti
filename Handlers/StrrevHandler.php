<?php

namespace App\Handlers;

class StrrevHandler
{
    public function process($str)
    {
        return $this->utf8Strrev($str);
    }

    protected function utf8Strrev($str)
    {
        preg_match_all('/./us', $str, $ar);

        return implode(array_reverse($ar[0]));
    }
}