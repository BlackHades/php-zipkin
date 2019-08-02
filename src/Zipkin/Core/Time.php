<?php
namespace BlackHades\PHPZipkin\Zipkin\Core;

class Time
{
    public static function microseconds()
    {
        return round(microtime(true) * 1000 * 1000);
    }
}
