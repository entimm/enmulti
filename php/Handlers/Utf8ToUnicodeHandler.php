<?php

namespace App\Handlers;

/**
 * 这样的中文转化成字符\u6211\u95ee\u95ee
 */
class Utf8ToUnicodeHandler
{
    public function process($str)
    {
        return trim(json_encode($str), '"');
    }
}