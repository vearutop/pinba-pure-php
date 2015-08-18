<?php

class PinbaTest extends PHPUnit_Framework_TestCase
{
    public function setUp() {
        require_once __DIR__ . '/../src/pinba_loader.php';

        if (class_exists('pinba', false)) {
            pinba::ini_set_auto_flush(false);
            pinba::ini_set_enabled(1);
            pinba::ini_set_server('127.0.0.1:3300');
        }
    }

    public function testOne() {
        pinba::flush();
    }

    public function testTwo() {
        $timer = pinba_timer_start(array('tag1' => 'value1', 'tag2' => 'value2'));
        $start = microtime(1);
        for ($i = 0; $i < 1000; ++$i) {
            md5($i);
        }
        $elapsed = microtime(1) - $start;
        $stop = pinba_timer_stop($timer);
        $this->assertTrue($stop);

        $info = pinba_timer_get_info($timer);
        $this->assertLessThan(0.1, abs($elapsed - $info['value']));


    }

    public function testPrepare() {
        //$struct = pinba::get_packet_info();

        //var_export($struct);
        //print_r($info);

        $testInfo = array (
            'mem_peak_usage' => 3407872,
            'req_time' => 0.047658920288085938,
            'ru_utime' => 0.054966000000000001,
            'ru_stime' => 0.030439999999999998,
            'req_count' => 0,
            'doc_size' => 0,
            'server_name' => 'unknown',
            'script_name' => '/private/var/folders/p5/fnl90gfx5_5f9599s3hpthfw0000gq/T/ide-phpunit.php',
            'hostname' => 'phph.local',
            'timers' =>
                array (
                    0 =>
                        array (
                            'value' => 0.0015180110931396484,
                            'tags' =>
                                array (
                                    'tag1' => 'value1',
                                    'tag2' => 'value2',
                                ),
                            'started' => false,
                            'data' =>
                                array (
                                ),
                            'count' => 1,
                            'tagids' =>
                                array (
                                    0 => 1,
                                    2 => 3,
                                ),
                        ),
                ),
            'status' => 0,
            'memory_peak' => 3407872,
            'request_time' => 0.047658920288085938,
            'request_count' => 0,
            'document_size' => 0,
            'timer_hit_count' =>
                array (
                    0 => 1,
                ),
            'timer_value' =>
                array (
                    0 => 0.0015180110931396484,
                ),
            'timer_tag_count' =>
                array (
                    0 => 2,
                ),
            'timer_tag_name' =>
                array (
                    0 => 0,
                    1 => 2,
                ),
            'timer_tag_value' =>
                array (
                    0 => 1,
                    1 => 3,
                ),
            'dictionary' =>
                array (
                    0 => 'tag1',
                    1 => 'value1',
                    2 => 'tag2',
                    3 => 'value2',
                ),
        );

        $expected = base64_decode('CgpwaHBoLmxvY2FsEgd1bmtub3duGkgvcHJpdmF0ZS92YXIvZm9sZGVycy9wNS9mbmw5MGdmeDVfNWY5NTk'
            . '5czNocHRoZncwMDAwZ3EvVC9pZGUtcGhwdW5pdC5waHAgASgAMICA0AE9ADZDPUUHJGE9TU9d+TxQAV0A+MY6aABwAWgCcANgAnoEdG'
            . 'FnMXoGdmFsdWUxegR0YWcyegZ2YWx1ZTKAAQA=');


        $this->assertSame($expected, pinba::prepareMessage($testInfo));
    }

}