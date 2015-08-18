<?php

class PinbaTest extends PHPUnit_Framework_TestCase
{
    public function setUp() {
        require_once __DIR__ . '/../src/pinba_loader.php';

        if (class_exists('pinba', false)) {
            pinba::ini_set_auto_flush(false);
            pinba::ini_set_enabled(1);
            pinba::ini_set_server('127.0.0.1:3300');
            //pinba::ini_set_server('192.168.56.101:3300');
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


    public function testPacketInfo() {
        $struct = pinba::get_packet_info();
        $this->assertSame( array (
            'tag1' => 0,
            'value1' => 1,
            'tag2' => 2,
            'value2' => 3,
        ), $struct['dictionary']);
        //print_r($struct);
    }

    public function testPrepare() {
        //$struct = pinba::get_packet_info();
        //var_export($struct);
        //print_r($info);

        $testInfo = array (
            'mem_peak_usage' => 3407872,
            'req_time' => 0.023175954818725586,
            'ru_utime' => 0.050366000000000001,
            'ru_stime' => 0.012817,
            'req_count' => 0,
            'doc_size' => 0,
            'server_name' => 'unknown',
            'script_name' => '/private/var/folders/p5/fnl90gfx5_5f9599s3hpthfw0000gq/T/ide-phpunit.php',
            'timers' =>
                array (
                    0 =>
                        array (
                            'value' => 0.0010178089141845703,
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
            'hostname' => 'phph.local',
            'memory_peak' => 3407872,
            'request_time' => 0.023175954818725586,
            'request_count' => 0,
            'document_size' => 0,
            'timer_hit_count' =>
                array (
                    0 => 1,
                ),
            'timer_value' =>
                array (
                    0 => 0.0010178089141845703,
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
                    'tag1' => 0,
                    'value1' => 1,
                    'tag2' => 2,
                    'value2' => 3,
                ),
        );

        $expected = base64_decode('CgpwaHBoLmxvY2FsEgd1bmtub3duGkgvcHJpdmF0ZS92YXIvZm9sZGVycy9wNS9mbmw5MGdmeDVfNWY5'
            . 'NTk5czNocHRoZncwMDAwZ3EvVC9pZGUtcGhwdW5pdC5waHAgASgAMICA0AE9gNu9PEWUTE49TWX+UTxQAV0AaIU6aABwAWgCcANg'
            . 'AnoEdGFnMXoGdmFsdWUxegR0YWcyegZ2YWx1ZTKAAQA=');

        //echo base64_encode(pinba::prepareMessage($testInfo));

        $this->assertSame($expected, pinba::prepareMessage($testInfo));
    }


    public function testFlush() {
        pinba_flush();
    }
}