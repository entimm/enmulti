<?php

namespace App\Handlers;

/**
 * sql str to json
 */
class InsertsqlToJsonHandler
{
    public function process($insertsql)
    {
        $string = str_replace('`', '', $insertsql);
        $arr = $this->getStringBetween($string, '(', ')');
        $result = [];
        if (count($arr) == 2) {
            $arr[0] = explode(',', $arr[0]);
            $arr[1] = array_map(function ($item) {
                return trim($item, '\'');
            }, explode(',', $arr[1]));

            $result = array_combine($arr[0], $arr[1]);
        }

        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    protected function getStringBetween($string, $start, $end)
    {
        $result = [];
        $string = ' '.$string;

        while (true) {
            $ini = strpos($string, $start);
            if ($ini == 0) {
                break;
            }
            $ini += strlen($start);
            $len = strpos($string, $end, $ini) - $ini;
            $goal = substr($string, $ini, $len);
            if (!$goal) {
                break;
            }
            $result[] = $goal;
            $string = substr($string, $ini + $len);
        }

        return $result;
    }
}