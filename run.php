<?php

include 'vendor/autoload.php';

use App\Log;

date_default_timezone_set('PRC');

// Log::channel('raw')->info($argv);

$method = $argv[1];
$data = json_decode($argv[2], true);
$sections = $data['selections'];
$callback = $data['callback'];

// Log::channel('input')->info($data);

$handler = implode('', array_map(function ($item) {
    return ucfirst($item);
}, explode('_', $method)));
$handler = 'App\\Handlers\\'.$handler.'Handler';

$result = [];
foreach ($sections as $key => $val) {
    if (class_exists($handler)) {
        $result[] = (new $handler($callback))->process($val, $sections, $key);
    } else {
        $result[] = $method($val);
    }
}

// Log::channel('output')->info($method, $result);

echo implode('↩', $result);