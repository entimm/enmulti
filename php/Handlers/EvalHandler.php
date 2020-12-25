<?php

namespace App\Handlers;

/**
 * eval
 */
class EvalHandler
{
    public function process($str)
    {
        return eval("return {$str};");
    }
}