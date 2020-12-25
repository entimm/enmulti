<?php

namespace App\Handlers;

/**
 * 统计重复次数
 */
class CountHandler
{
    public function process($str, $sections, $key)
    {
        $count = 0;
        foreach ($sections as $k => $v) {
            if ($str == $v) {
                $count++;
            }
        }

        return $str.'#count='.$count;
    }
}