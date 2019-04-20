<?php

namespace App\Handlers;

class DateHandler
{
    public function process($timestamp)
    {
        return date('Y-m-d', $timestamp);
    }
}