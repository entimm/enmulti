<?php

namespace App\Handlers;

class DatetimeHandler
{
    public function process($timestamp)
    {
        return date('Y-m-d H:i:s', $timestamp);
    }
}