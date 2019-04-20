<?php

namespace App\Handlers;

class JsonTokvHandler
{
    public function process($str)
    {
        $arr = json_decode($str, true);

        $output = '';

        foreach ($arr as $key => $value) {
            $output .= $key.':'.$value.PHP_EOL;
        }

        return $output;
    }
}