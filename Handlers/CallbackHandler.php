<?php

namespace App\Handlers;

class CallbackHandler
{
    private $callback;

    public function __construct($callback)
    {
        $this->callback = $callback;
    }

    public function process($str)
    {
        return call_user_func($this->callback, $str);
    }
}