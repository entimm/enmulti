<?php

namespace App\Handlers;

class EvalHandler
{
    public function process($str)
    {
        return eval("return {$str};");
    }
}