<?php

/**
 * Flush only stopped timers (by default all existing timers are stopped and flushed)
 * @since 1.0.0.
 */
const PINBA_FLUSH_ONLY_STOPPED_TIMERS = 1;

/**
 * Reset common request data
 * @since 1.1.0.
 */
const PINBA_FLUSH_RESET_DATA = 2;

/**
 * @since 1.0.0.
 */
const PINBA_ONLY_STOPPED_TIMERS = 1;

/**
 * Creates and starts new timer.
 *
 * @param array $tags An array of tags and their values in the form of "tag" => "value". Cannot contain numeric indexes for obvious reasons.
 * @param array $data Optional array with user data, not sent to the server.
 *
 * @return resource Always returns new timer resource.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_timer_start
 *
 * @example
 * <pre>
 * $time = pinba_timer_start(array('tag' => 'value'), array('customData', 1, 2));
 * </pre>
 */
function pinba_timer_start(array $tags, array $data = array()) {
    return pinba::timer_start($tags, $data);
};

/**
 * Stops the timer.
 *
 * @param int $timer Valid timer resource.
 *
 * @return bool Returns true on success and false on failure (if the timer has already been stopped).
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_timer_stop
 */
function pinba_timer_stop($timer) {
    return pinba::timer_stop($timer);
}

/**
 * Creates new timer. This timer is already stopped and have specified time value.
 *
 * @param array $tags An array of tags and their values in the form of "tag" => "value". Cannot contain numeric indexes for obvious reasons.
 * @param integer $value Timer value for new timer.
 * @param array $data Optional array with user data, not sent to the server.
 *
 * @return resource Always returns new timer resource.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_timer_add
 */
function pinba_timer_add(array $tags, $value, array $data = array()) {
    return pinba::timer_add($tags, $value, $data);
}

/**
 * Deletes the timer.
 *
 * @param int $timer Valid timer resource.
 *
 * @return bool Returns true on success and false on failure.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_timer_delete
 * @since 0.0.6
 */
function pinba_timer_delete($timer) {
    return pinba::timer_delete($timer);
}

/**
 * Merges $tags array with the timer tags replacing existing elements.
 *
 * @param int $timer Valid timer resource
 * @param array $tags An array of tags and their values in the form of "tag" => "value". Cannot contain numeric indexes for obvious reasons.
 *
 * @return bool Returns true on success and false on failure.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_timer_tags_merge
 */
function pinba_timer_tags_merge($timer, array $tags) {
    return pinba::timer_tags_merge($timer, $tags);
}

/**
 * Replaces timer tags with the passed $tags array.
 *
 * @param int $timer Valid timer resource
 * @param array $tags An array of tags and their values in the form of "tag" => "value". Cannot contain numeric indexes for obvious reasons.
 *
 * @return bool Returns true on success and false on failure.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_timer_tags_replace
 */
function pinba_timer_tags_replace($timer, array $tags) {
    return pinba::timer_tags_replace($timer, $tags);
}

/**
 * Merges $data array with the timer user data replacing existing elements.
 *
 * @param int $timer Valid timer resource
 * @param array $data An array of user data.
 *
 * @return bool Returns true on success and false on failure.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_timer_data_merge
 */
function pinba_timer_data_merge($timer, array $data) {
    return pinba::timer_data_merge($timer, $data);
}


/**
 * Replaces timer user data with the passed $data array.
 * Use NULL value to reset user data in the timer.
 *
 * @param int $timer Valid timer resource
 * @param array $data An array of user data.
 *
 * @return bool Returns true on success and false on failure.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_timer_data_replace
 */
function pinba_timer_data_replace($timer, array $data) {
    return pinba::timer_data_replace($timer, $data);
}

/**
 * Returns timer data.
 *
 * @param int $timer Valid timer resource.
 *
 * @return array Array with timer data.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_timer_get_info
 *
 * @example
 * <pre>
 * $data = pinba_timer_get_info($timerRes);
 * //$data == array(
 * //     "value" => 0.0213,
 * //     "tags" => array(
 * //         "foo" => "bar",
 * //     },
 * //      "started" => true,
 * //     "data"  => array('customData', 1, 2),
 * //);
 * </pre>
 */
function pinba_timer_get_info($timer) {
    return pinba::timer_get_info($timer);
}

/**
 * Stops all running timers.
 *
 * @return bool Returns true on success and false on failure.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_timers_stop
 */
function pinba_timers_stop() {
    return pinba::timers_stop();
}

/**
 * Get all timers info.
 *
 * @param int $flags Is an optional argument added in version 1.0.0.
 * Possible values (it's a bitmask, so you can add the constants) is a PINBA_ONLY_STOPPED_TIMERS.
 *
 * @return array Array with all timers data.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_timers_get
 * @since 1.1.0
 */
function pinba_timers_get($flags) {
    return pinba::timers_get($flags);
}

/**
 * Returns all request data (including timers user data).
 *
 * @return array Requested data
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_get_info
 *
 * @example
 * <pre>
 * $data = pinba_get_info();
 * //$data == array(
 * //    "mem_peak_usage" => 786432,
 * //    "req_time" => 0.001529,
 * //    "ru_utime" => 0,
 * //    "ru_stime" => 0,
 * //    "req_count" => 1,
 * //    "doc_size" => 0,
 * //    "server_name" => "unknown",
 * //    "script_name" => "-",
 * //    "timers" =>array(
 * //        array(
 * //            "value" => 4.5E-5,
 * //            "tags" => array("foo" => "bar"),
 * //            "started" => true,
 * //            "data" => null,
 * //        ),
 * //    ),
 * //);
 * </pre>
 */
function pinba_get_info() {
    return pinba::get_info();
}

/**
 * Set custom script name instead of $_SERVER['SCRIPT_NAME'] used by default.
 * Useful for those using front controllers, when all requests are served by one PHP script.
 *
 * @param string $script_name Custom script name
 *
 * @return bool Returns true on success and false on failure.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_script_name_set
 */
function pinba_script_name_set($script_name) {
    return pinba::script_name_set($script_name);
}

/**
 * Set custom hostname instead of the result of gethostname() used by default.
 *
 * @param string $hostname Custom host name
 *
 * @return bool Returns true on success and false on failure.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_hostname_set
 */
function pinba_hostname_set($hostname) {
    return pinba::hostname_set($hostname);
}

/**
 * Useful when you need to send request data to the server immediately (for long running scripts).
 * You can use optional argument script_name to set custom script name.
 *
 * @param string $script_name Custom script name
 * @param int $flags Is an optional argument added in version 1.0.0.
 * Possible values (it's a bitmask, so you can add the constants) is a PINBA_FLUSH_ONLY_STOPPED_TIMERS and
 * PINBA_FLUSH_RESET_DATA.
 *
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_flush
 */
function pinba_flush($script_name = '', $flags) {
    pinba::flush($script_name, $flags);
}

/**
 * Set request schema (HTTP/HTTPS/whatever).
 *
 * @param string $schema Schema
 *
 * @return bool Returns true on success and false on failure.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_schema_set
 * @since 1.1.0.
 */
function pinba_schema_set($schema) {
    pinba::$schema = $schema;
    return true;
}

/**
 * Set custom server name instead of $_SERVER['SERVER_NAME'] used by default.
 *
 * @param string $server_name Custom server name
 *
 * @return bool Returns true on success and false on failure.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_server_name_set
 * @since 1.1.0.
 */
function pinba_server_name_set($server_name) {
    pinba::$serverName = $server_name;
    return true;
}

/**
 * Set custom request time.
 *
 * @param float $request_time
 *
 * @return bool Returns true on success and false on failure.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_request_time_set
 * @since 1.1.0.
 */
function pinba_request_time_set($request_time) {
    pinba::$requestTime = $request_time;
    return true;
}

/**
 * Set/update request tag.
 *
 * @param string $tag Custom tag name string
 * @param string $value Tag value
 *
 * @return bool Returns true on success and false on failure.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_tag_set
 * @since 1.1.0.
 */
function pinba_tag_set($tag, $value) {
    pinba::$requestTags[$tag] = $value;
    return true;
}

/**
 * Get previously set request tag value.
 *
 * @return string Returns request tag string.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_tag_get
 * @since 1.1.0.
 */
function pinba_tag_get($tag) {
    return isset(pinba::$requestTags[$tag]) ? pinba::$requestTags[$tag] : '';
}

/**
 * Delete previously set request tag.
 *
 * @param string $tag Custom tag name string
 *
 * @return bool Returns true on success and false on failure.
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_tag_delete
 * @since 1.1.0.
 */
function pinba_tag_delete($tag) {
    if (isset(pinba::$requestTags[$tag])) {
        unset(pinba::$requestTags[$tag]);
        return true;
    }
    return false;
}

/**
 * Return an array of all previously set request tags.
 *
 * @return array Returns array of all previously set request tags
 * @link https://github.com/tony2001/pinba_engine/wiki/PHP-extension#pinba_tags_get
 * @since 1.1.0.
 */
function pinba_tags_get() {
    return pinba::$requestTags;
}

/**
 * A class implementing the pinba extension functionality, in pure php
 *
 * @see http://pinba.org/wiki/Manual:PHP_extension
 */
class pinba
{
    public static $schema; // todo use it
    public static $requestTime;
    public static $requestTags = array(); // todo use it

    private static $timers = array();
    private static $scriptName = null;
    public static $serverName = null;
    private static $hostname = null;
    private static $start = null;
    private static $shutdownRegistered = false;
    private static $timerId = 0;

    /**
     * Creates and starts new timer.
     *
     * @param array $tags an array of tags and their values in the form of "tag" => "value". Cannot contain numeric indexes for obvious reasons.
     * @param array $data optional array with user data, not sent to the server.
     * @return integer Always returns new timer resource.
     */
    static function timer_start($tags, $data = null)
    {
        $time = microtime(true);
        ++self::$timerId;
        self::$timers[self::$timerId] = array(
            "value" => $time,
            "tags" => $tags,
            "started" => false,
            "data" => $data
        );
        return self::$timerId;
    }

    static function timer_add($tags, $value, $data = null) {
        ++self::$timerId;
        self::$timers[self::$timerId] = array(
            "value" => $value,
            "tags" => $tags,
            "started" => false,
            "data" => $data
        );
        return self::$timerId;
    }

    /**
     * Stops the timer.
     *
     * @param integer $timer valid timer resource.
     * @return bool Returns true on success and false on failure (if the timer has already been stopped).
     */
    static function timer_stop($timer)
    {
        $time = microtime(true);
        if (isset(self::$timers[$timer])) {
            if (self::$timers[$timer]["started"]) {
                self::$timers[$timer]["started"] = false;
                self::$timers[$timer]["value"] = $time - self::$timers[$timer]["value"];
                return true;
            }
            else {
                return false;
            }
        }
        return false;
    }

    /**
     * Deletes the timer.
     *
     * @param integer $timer valid timer resource.
     * @return bool Returns true on success and false on failure.
     */
    static function timer_delete($timer)
    {
        if (isset(self::$timers[$timer])) {
            unset(self::$timers[$timer]);
            return true;
        }
        return false;
    }

    /**
     * Merges $tags array with the timer tags replacing existing elements.
     *
     * @param integer $timer - valid timer resource
     * @param array $tags - an array of tags.
     * @return bool
     */
    static function timer_tags_merge($timer, $tags)
    {
        if (isset(self::$timers[$timer])) {
            self::$timers[$timer]["tags"] = array_merge(self::$timers[$timer]["tags"], $tags);
            return true;
        }
        return false;
    }

    /**
     * Replaces timer tags with the passed $tags array.
     *
     * @param integer $timer - valid timer resource
     * @param array $tags - an array of tags.
     * @return bool
     */
    static function timer_tags_replace($timer, $tags)
    {
        if (isset(self::$timers[$timer])) {
            self::$timers[$timer]["tags"] = $tags;
            return true;
        }
        return false;
    }

    /**
     * Merges $data array with the timer user data replacing existing elements.
     *
     * @param integer $timer valid timer resource
     * @param array $data an array of user data.
     * @return bool Returns true on success and false on failure.
     */
    static function timer_data_merge($timer, $data)
    {
        if (isset(self::$timers[$timer])) {
            self::$timers[$timer]["data"] = array_merge(self::$timers[$timer]["data"], $data);
            return true;
        }
        return false;
    }

    /**
     * Replaces timer user data with the passed $data array.
     * Use NULL value to reset user data in the timer.
     *
     * @param integer $timer valid timer resource
     * @param array $data an array of user data.
     * @return bool Returns true on success and false on failure.
     */
    static function timer_data_replace($timer, $data)
    {
        if (isset(self::$timers[$timer])) {
            self::$timers[$timer]["data"] = $data;
            return true;
        }
        return false;
    }

    /**
     * Returns timer data.
     *
     * @param integer $timer - valid timer resource.
     * @return array Output example:
     * array(4) {
     * ["value"]=>
     * float(0.0213)
     * ["tags"]=>
     * array(1) {
     * ["foo"]=>
     * string(3) "bar"
     * }
     * ["started"]=>
     * bool(true)
     * ["data"]=>
     * NULL
     * }
     */
    static function timer_get_info($timer)
    {
        $time = microtime(true);
        return static::_timer_get_info($timer, $time);
    }

    private static function _timer_get_info($timer, $time)
    {
        if (isset(self::$timers[$timer])) {
            $timer = self::$timers[$timer];
            if ($timer["started"]) {
                $timer["value"] = $time - $timer["value"];
            }
            return $timer;
        }
        return array();
    }

    static function timers_get($flags = 0) {
        if ($flags & PINBA_ONLY_STOPPED_TIMERS) {
            $result = array();
            foreach (self::$timers as $timer => $timerData) {
                if (!$timerData['started']) {
                    $result []= $timer;
                }
            }
            return $result;
        }
        else {
            return array_keys(self::$timers);
        }
    }


    /**
     * Stops all running timers.
     *
     * @return bool
     */
    static function timers_stop()
    {
        $time = microtime(true);
        foreach (self::$timers as &$timer) {
            if ($timer["started"]) {
                $timer["started"] = false;
                $timer["value"] = $time - $timer["value"];
            }
        }
        return true;
    }

    /**
     * Returns all request data (including timers user data).
     *
     * @return array Example:
     * array(9) {
     * ["mem_peak_usage"]=>
     * int(786432)
     * ["req_time"]=>
     * float(0.001529)
     * ["ru_utime"]=>
     * float(0)
     * ["ru_stime"]=>
     * float(0)
     * ["req_count"]=>
     * int(1)
     * ["doc_size"]=>
     * int(0)
     * ["server_name"]=>
     * string(7) "unknown"
     * ["script_name"]=>
     * string(1) "-"
     * ["timers"]=>
     * array(1) {
     * [0]=>
     * array(4) {
     * ["value"]=>
     * float(4.5E-5)
     * ["tags"]=>
     * array(1) {
     * ["foo"]=>
     * string(3) "bar"
     * }
     * ["started"]=>
     * bool(true)
     * ["data"]=>
     * NULL
     * }
     * }
     * }
     */
    static function get_info()
    {
        $time = microtime(true);
        $results = array(
            "mem_peak_usage" => memory_get_peak_usage(true),
            "req_time" => null === self::$requestTime ? ($time - self::$start) : self::$requestTime,
            "ru_utime" => 0,
            "ru_stime" => 0,
            "req_count" => 0,
            "doc_size" => 0,
            "server_name" => (self::$serverName != null ? self::$serverName : 'unknown'),
            "script_name" => (self::$scriptName != null ? self::$scriptName : '-')
        );
        if (function_exists('getrusage')) {
            $rUsage = getrusage();
            if (isset($rUsage['ru_utime.tv_usec'])) {
                $results['ru_utime'] = $rUsage['ru_utime.tv_usec'] / 1000000;
            }
            if (isset($rUsage['ru_utime.tv_usec'])) {
                $results['ru_stime'] = $rUsage['ru_stime.tv_usec'] / 1000000;
            }
        }

        foreach (self::$timers as $i => $t) {
            $results['timers'][] = self::_timer_get_info($i, $time);
        }
        return $results;
    }

    /**
     * Set custom script name instead of $_SERVER['SCRIPT_NAME'] used by default.
     * Useful for those using front controllers, when all requests are served by one PHP script.
     *
     * @param string $script_name
     * @return bool
     */
    static function script_name_set($script_name)
    {
        self::$scriptName = $script_name;
        return true;
    }

    /**
     * Set custom hostname instead of the result of gethostname() used by default.
     *
     * @param string $hostname
     * @return bool
     */
    static function hostname_set($hostname)
    {
        self::$hostname = $hostname;
        return true;
    }


    private static $server;

    static function ini_set_server($server)
    {
        self::$server = $server;
    }

    private static $enabled;

    static function ini_set_enabled($enabled)
    {
        self::$enabled = $enabled;
    }


    /**
     * Useful when you need to send request data to the server immediately (for long running scripts).
     * You can use optional argument script_name to set custom script name.
     *
     * @param string $script_name
     * @return bool
     */
    static function flush($script_name = null, $flags = null)
    {
        if (self::$enabled || get_cfg_var('pinba.enabled')) {
            $struct = static::get_packet_info($script_name);
            $message = self::prepareMessage($struct);

            if (null === self::$server) {
                self::$server = get_cfg_var('pinba.server');
            }

            if (!self::$server) {
                return false;
            }
            $port = 30002;
            if (count($server = explode(':', self::$server)) > 1) {
                $port = $server[1];
                $server = $server[0];
            } else {
                $server = $server[0];
            }

            $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

            if (!socket_sendto($sock, $message, strlen($message), 0, $server, $port)) {
                /*
                $errorcode = socket_last_error();
                $errormsg = socket_strerror($errorcode);
                */
                return false;
            }
        }
        return true;
    }


    private static function prepareMessage($struct)
    {
        self::$resource = fopen('php://memory', 'wb');

        self::stringField(1, $struct['hostname']);
        self::stringField(2, $struct['server_name']);
        self::stringField(3, $struct['script_name']);
        self::integerField(4, 1);
        self::integerField(5, $struct['doc_size']);
        self::integerField(6, $struct['memory_peak']);
        self::floatField(7, $struct['request_time']);
        self::floatField(8, $struct['ru_utime']);
        self::floatField(9, $struct['ru_stime']);

        $dictionary = array_flip($struct['dictionary']);
        foreach ($struct['timers'] as $timer) {
            self::integerField(10, 1);
            self::floatField(11, $timer['value']);

            $tag_count = 0;
            foreach ($timer['tags'] as $tagName => $tagValue) {
                self::integerField(13, $dictionary[$tagName]);
                self::integerField(14, $dictionary[$tagValue]);

                ++$tag_count;
            }

            // tag_count
            self::integerField(12, $tag_count);
        }

        foreach ($struct['dictionary'] as $value) {
            self::stringField(15, $value);
        }

        if (is_int($struct['status'])) {
            self::integerField(16, $struct['status']);
        }

        fseek(self::$resource, 0, SEEK_SET);
        $buffer = stream_get_contents(self::$resource);
        fclose(self::$resource);
        return $buffer;
    }

    /**
     * Builds the php array structure to be sent to the pinba server
     */
    static private function get_packet_info($script_name = null)
    {
        $struct = static::get_info();
        // massage info into correct format for pinba server
        $struct["status"] = 0;
        $struct["hostname"] = self::$hostname;
        if ($script_name != null) {
            $struct["script_name"] = $script_name;
        }
        foreach (array(
                     "mem_peak_usage" => "memory_peak",
                     "req_time" => "request_time",
                     "req_count" => "request_count",
                     "doc_size" => "document_size",
                 ) as $old => $new) {
            $struct[$new] = $struct[$old];
        }
        // merge timers by tags
        $tags = array();
        foreach ($struct["timers"] as $id => $timer) {
            $tag = md5(var_export($timer["tags"], true));
            if (isset($tags[$tag])) {
                $struct["timers"][$tags[$tag]]["value"] = $struct["timers"][$tags[$tag]]["value"] + $timer["value"];
                $struct["timers"][$tags[$tag]]["count"] = $struct["timers"][$tags[$tag]]["count"] + 1;
                unset($struct["timers"][$id]);
            } else {
                $tags[$tag] = $id;
                $struct["timers"][$id]["count"] = 1;
            }
        }
        // build tag dictionary and index timer tags
        $dict = array();
        foreach ($struct["timers"] as $id => $timer) {
            foreach ($timer['tags'] as $tag => $value) {
                if (($tagid = array_search($tag, $dict)) === false) {
                    $tagid = count($dict);
                    $dict[] = $tag;
                }
                if (($valueid = array_search($value, $dict)) === false) {
                    $valueid = count($dict);
                    $dict[] = $value;
                }
                $struct["timers"][$id]['tagids'][$tagid] = $valueid;
            }
        }
        foreach ($struct["timers"] as $timer) {
            $struct["timer_hit_count"][] = $timer["count"];
            $struct["timer_value"][] = $timer["value"];
            $struct["timer_tag_count"][] = count($timer["tags"]);
            foreach ($timer["tagids"] as $key => $val) {
                $struct["timer_tag_name"][] = $key;
                $struct["timer_tag_value"][] = $val;
            }
        }
        foreach ($dict as $tag) {
            $struct["dictionary"][] = $tag;
        }
        return $struct;
    }

    /**
     * A function not in the pinba extension api, needed to calculate total req. time
     */
    static function init($time = null)
    {
        if (self::$start == null || $time != null) {
            if ($time == null) {
                $time = microtime(true);
            }
            self::$start = $time;
        }
        if (self::$hostname == null) {
            self::$hostname = gethostname();
        }
        if (self::$scriptName == null && isset($_SERVER['SCRIPT_NAME'])) {
            self::$scriptName = $_SERVER['SCRIPT_NAME'];
        }
        if (self::$serverName == null && isset($_SERVER['SERVER_NAME'])) {
            self::$serverName = $_SERVER['SERVER_NAME'];
        }
        if (!self::$shutdownRegistered) {
            self::$shutdownRegistered = true;
            register_shutdown_function('pinba::flush');
        }

    }


    /**
     * @var resource
     */
    private static $resource;

    private static function writeString($value)
    {
        $bytes = $value;
        $length = strlen($bytes);
        self::writeInteger($length);

        self::write($bytes, $length);
    }

    private static function writeFloat($value)
    {
        static $packer;

        if (!$packer) {
            list(, $result) = unpack('L', pack('V', 1));
            $packer = ($result === 1)
                ? function ($value) {
                    return pack('f*', $value);
                }
                : function ($value) {
                    return strrev(pack('f*', $value));
                };
        }
        $bytes = $packer($value);

        self::write($bytes, 4);
    }

    private static function writeInteger($value)
    {
        if ($value < 0x80) {

            self::write(chr($value), 1);
            return;
        }

        $values = array('C*');
        do {
            $values[] = 0x80 | ($value & 0x7f);
            $value = $value >> 7;
        } while ($value > 0);

        // last MSB flag removal
        end($values);
        $values[key($values)] &= 0x7f;

        $bytes = call_user_func_array('pack', $values);
        $length = strlen($bytes);

        self::write($bytes, $length);
    }

    private static function write($bytes, $length)
    {
        fwrite(self::$resource, $bytes, $length);
    }

    private static function stringField($field_id, $field_value)
    {
        self::writeInteger($field_id << 3 | 2);
        self::writeString($field_value);
    }

    private static function integerField($field_id, $field_value)
    {
        self::writeInteger($field_id << 3 | 0);
        self::writeInteger($field_value);
    }

    private static function floatField($field_id, $field_value)
    {
        self::writeInteger($field_id << 3 | 5);
        self::writeFloat($field_value);
    }

}

// try to start time measurement as soon as we can
pinba::init();
