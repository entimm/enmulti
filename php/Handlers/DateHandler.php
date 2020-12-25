<?php

namespace App\Handlers;

/**
 * 时间戳 TO date
 */
class DateHandler
{
    public function process($timestamp)
    {
        return date('Y-m-d', $timestamp);
    }
}