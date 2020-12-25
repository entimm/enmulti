<?php

namespace App\Support;

class Env
{
    private $param = [];

    public function __construct()
    {
        $envFile = SUPPORT_PATH.'/env.json';
        $this->param = json_decode(file_get_contents($envFile), true);
    }

    public function get($field, $default = null)
    {
        return isset($this->param[$field]) ? $this->param[$field] : $default;
    }

    public function set($field, $value)
    {
        $this->param[$field] = $value;
    }

    public function __get($name)
    {
        return isset($this->param[$name]) ? $this->param[$name] : null;
    }

    public function __set($name, $value)
    {
        $this->param[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->param[$name]);
    }

    public function all()
    {
        return $this->param;
    }
}