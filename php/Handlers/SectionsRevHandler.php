<?php

namespace App\Handlers;

/**
 * 选项倒立翻转
 */
class SectionsRevHandler
{
    public function process($str, $sections, $key)
    {
        $count = count($sections);

        return $sections[$count - $key - 1];
    }
}