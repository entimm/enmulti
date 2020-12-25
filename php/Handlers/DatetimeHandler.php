<?php

namespace App\Handlers;

/**
 * 时间戳 TO datetime
 */
class DatetimeHandler
{
    public function process($timestamp)
    {
        return date('Y-m-d H:i:s', $timestamp);
    }
}