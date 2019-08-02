<?php
namespace BlackHades\PHPZipkin\Zipkin\Transport;

use BlackHades\PHPZipkin\Zipkin\Core\Span;

interface LoggerInterface
{
    /**
     * @param Span[] $spans
     * @throws \Exception
     */
    public function trace(array $spans);
}
