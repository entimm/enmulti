<?php

namespace App\Support;

abstract class Command
{
    /**
     * @var Env
     */
    protected $env;

    /**
     * @var Mapper
     */
    protected $mapper;

    public function init()
    {
        $this->env = new Env();
        $this->mapper = new Mapper();
    }
}