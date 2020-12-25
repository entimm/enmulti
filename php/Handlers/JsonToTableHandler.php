<?php

namespace App\Handlers;

/**
 * json to table
 */
class JsonToTableHandler
{
    public function process($str)
    {
        $arr = json_decode($str, true);
        $keys = array_keys(current($arr));

        $output = implode('|', $keys).PHP_EOL;
        $separates = array_pad([], count($keys), '-');
        $output .= implode('|', $separates).PHP_EOL;
        foreach ($arr as $key => $value) {
            $output .= implode('|', $value).PHP_EOL;
        }

        return $output;
    }
}