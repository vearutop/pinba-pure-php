<?php

require_once __DIR__ . '/../vendor/autoload.php';

if (class_exists('pinba', false)) {
    pinba::ini_set_auto_flush(true);
    pinba::ini_set_enabled(1);
    pinba::ini_set_server('127.0.0.1:3300');
}
var_dump(ini_set('pinba.enabled', 1));
var_dump(ini_set('pinba.server', '127.0.0.1:3300'));

$file = file_get_contents(__FILE__);


$timer = pinba_timer_start(array('action' => 'gzencode', 'tag2' => 'value2'));
$start = microtime(1);
gzencode($file);
$elapsed = microtime(1) - $start;
$stop = pinba_timer_stop($timer);


$timer = pinba_timer_start(array('action' => 'md5', 'tag2' => 'value2'));
$start = microtime(1);
for ($i = 0; $i < 1000; ++$i) {
    md5($i);
}
$elapsed = microtime(1) - $start;
$stop = pinba_timer_stop($timer);



$timer = pinba_timer_start(array('action' => 'serialize', 'tag2' => 'value3'));
$start = microtime(1);
for ($i = 0; $i < 1000; ++$i) {
    serialize($_SERVER);
}
$elapsed = microtime(1) - $start;
$stop = pinba_timer_stop($timer);


header("Content-Type: text/plain");
echo $file;
