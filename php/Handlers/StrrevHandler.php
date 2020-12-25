<?php

namespace App\Handlers;

use App\Support\Helper;

/**
 * 字符串左右翻转
 */
class StrrevHandler
{
    public function process($str)
    {
        return Helper::utf8Strrev($str);
    }
}