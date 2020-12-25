<?php

namespace App\Handlers;

use App\Support\Helper;

/**
 * utf8字符串左右翻转
 */
class Utf8StrrevHandler
{
    public function process($str)
    {
        return Helper::utf8Strrev($str);
    }
}