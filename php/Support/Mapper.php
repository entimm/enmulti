<?php

namespace App\Support;

class Mapper
{
    private $data = [];

    public function __construct()
    {
        $mapperFile = SUPPORT_PATH.'/mapper.json';
        $this->data = json_decode(file_get_contents($mapperFile), true);
    }

    public function get()
    {
        return $this->data;
    }
}