<?php

namespace App\Handlers;

use App\Support\Command;

/**
 * 字符根据固定行高分段
 */
class SplitHandler extends Command
{
    public function __construct()
    {
        $this->init();
    }

    public function process($str, $sections, $key)
    {
        $height = $this->env->SPLIT_HEIGHT;

        $lines = explode(PHP_EOL, $str);
        $lines = array_chunk($lines, $height);
        $lines = array_map(function ($item) {
            return implode(PHP_EOL, $item);
        }, $lines);

        return implode(PHP_EOL.PHP_EOL, $lines);
    }
}