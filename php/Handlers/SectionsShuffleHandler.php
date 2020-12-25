<?php

namespace App\Handlers;

/**
 * 随机
 */
class SectionsShuffleHandler
{
    public function process($str, $sections, $key)
    {
        $items = array_values(array_unique($sections));

        return $items[mt_rand(0, PHP_INT_MAX) % count($items)];
    }
}