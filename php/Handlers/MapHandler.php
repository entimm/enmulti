<?php

namespace App\Handlers;

use App\Support\Command;

/**
 * 根据映射进行替换
 */
class MapHandler extends Command
{
    public function __construct()
    {
        $this->init();
    }

    public function process($str, $sections, $key)
    {
        $map = $this->mapper->get();

        return isset($map[$str]) ? $map[$str] : '@@@'.$str;
    }
}