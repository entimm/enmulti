<?php

namespace App\Handlers;

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