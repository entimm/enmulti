<?php

namespace App;

class Log
{
    private static $storage = [];
    private static $traceNo;

    private $channel;

    private static $instances = [];

    public static function channel($name)
    {
        if (isset(self::$instances[$name])) {
            return self::$instances[$name];
        }

        return self::$instances[$name] = new self($name);
    }

    private function __construct($name)
    {
        $this->channel = $name;
    }

    public static function setTraceNo($traceNo)
    {
        if (empty(static::$traceNo)) {
            static::$traceNo = $traceNo;
        }
    }

    public static function getTraceNo()
    {
        if (!static::$traceNo) {
            static::$traceNo = date('Ymd-His').'-'.sprintf('%05s', getmypid()).'-'.uniqid('', false);
        }

        return static::$traceNo;
    }

    protected function add($tag, ...$data)
    {
        if (!is_string($this->channel)) {
            return false;
        }

        $data = array_map(function($item) {
            return is_string($item) ? $item : json_encode($item, JSON_UNESCAPED_UNICODE);
        }, $data);

        array_unshift($data, $tag);
        array_unshift($data, static::getTraceNo());

        self::$storage[$this->channel][] = implode(' || ', $data);

        $this->save($this->channel);

        return true;
    }

    protected function save($name)
    {
        $fileName = $name.'-'.date('Y-m-d').'.log';

        $log_dir = __DIR__.'/logs/';

        error_log(join('', self::$storage[$name])  . "\r\n", 3, $log_dir.$fileName);

        self::$storage[$name] = [];
    }

    public function __call($method, $args)
    {
        if (in_array($method, ['debug', 'info', 'notice', 'warning', 'error', 'critical', 'alert', 'emergency'])) {
            $this->add($method, ...$args);
        }
    }
}
