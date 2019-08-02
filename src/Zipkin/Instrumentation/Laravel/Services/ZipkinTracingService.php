<?php
namespace BlackHades\PHPZipkin\Zipkin\Instrumentation\Laravel\Services;

use BlackHades\PHPZipkin\Zipkin\Core\Endpoint;
use BlackHades\PHPZipkin\Zipkin\Core\Trace;
use BlackHades\PHPZipkin\Zipkin\Tracer;

class ZipkinTracingService
{
    /** @var Trace $trace */
    private $trace;

    public function createTrace(
        Tracer $tracer = null,
        Endpoint $endpoint = null,
        $sampled = 1.0,
        $debug = false
    ) {
//        dd("here",$sampled, $debug);
        $this->trace = new Trace($tracer, $endpoint, $sampled, $debug);
    }

    /**
     * @return Trace
     */
    public function getTrace():Trace
    {
        return $this->trace;
    }
}
