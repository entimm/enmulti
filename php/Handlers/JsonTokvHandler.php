<?php

namespace App\Handlers;

/**
 * json to kv(postman用)
 */
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