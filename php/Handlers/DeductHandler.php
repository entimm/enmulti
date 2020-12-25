<?php

namespace App\Handlers;

use App\Support\Command;

/**
 * deduct
 */
class DeductHandler extends Command
{
    public function __construct()
    {
        $this->init();
    }

    public function process($value)
    {
        $deductPercent = $this->env->DEDUCT_PERCENT;

        $deductValue = $value * $deductPercent / 100;
        $deductValue = $deductValue * mt_rand(9000, 12000) / 10000;

        return $value - (int)$deductValue;
    }
}