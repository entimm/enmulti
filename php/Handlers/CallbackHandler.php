<?php

namespace App\Handlers;

/**
 * 接受方法并替代参数最后执行
 */
class CallbackHandler
{
    private $callback;
    private $args;

    public function __construct($callback)
    {
        $fragments = preg_split('/\s+/', $callback);
        $this->callback = array_shift($fragments);
        $this->args = $fragments ?: ['$$'];
    }

    public function process($str, $sections, $key)
    {
        $this->args = array_map(function ($item) use ($str, $sections, $key) {
            $item = $item === '$$' ? $str : $item;

            return $item;
        }, $this->args);

        return call_user_func_array($this->callback, $this->args);
    }
}