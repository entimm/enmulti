<?php

namespace App\Handlers;

class ToggleTimeHandler
{
    public function process($timestamp)
    {
        if (!$timestamp) {
            $timestamp = time();
        }
        return $this->is_timestamp($timestamp) ? date('Y-m-d H:i:s', $timestamp) : strtotime($timestamp);
    }

    private function is_timestamp($timestamp)
    {
        return is_numeric($timestamp) && (int)$timestamp == $timestamp;
    }
}