<?php

use App\Log;

include 'vendor/autoload.php';

date_default_timezone_set('PRC');

// Log::channel('raw')->info($argv);

define('LINE_DIVIDE_SYMBOL', '↩');
define('HOME_PATH', '/Users/'.trim(shell_exec("whoami")));
define('SUPPORT_PATH', HOME_PATH.'/OneDrive/Dev/SublimeText');

$method = $argv[1];
$data = json_decode($argv[2], true);
$sections = $data['selections'];
$callback = $data['callback'];

// Log::channel('input')->info($data);

set_error_handler(function ($errno , $errstr, $errfile, $errline) {
    Log::channel('system_err')->error(compact('errno', 'errstr', 'errfile', 'errline'));
});

set_exception_handler(function ($exception) {
    Log::channel('system_ex')->error($exception->getMessage());
});

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

echo implode(LINE_DIVIDE_SYMBOL, $result);