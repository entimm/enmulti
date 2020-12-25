<?php

namespace App\Handlers;

/**
 * 这样的\u6211\u95ee\u95ee字符转化成中文
 */
class UnicodeToUtf8Handler
{
    public function process($str)
    {
        return json_decode("\"$str\"");
    }
}