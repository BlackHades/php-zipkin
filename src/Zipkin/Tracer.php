<?php
namespace BlackHades\PHPZipkin\Zipkin;

use  BlackHades\PHPZipkin\Zipkin\Core\Span;
use  BlackHades\PHPZipkin\Zipkin\Transport\HTTPLogger;
use  BlackHades\PHPZipkin\Zipkin\Transport\LoggerInterface;
use GuzzleHttp\Client;

class Tracer
{
    /** @var LoggerInterface $logger */
    private $logger;

    /** @var float $sampled */
    private $sampled;

    /** @var bool $debug */
    private $debug;

    /**
     * @param LoggerInterface $logger
     * @param float           $sampled
     * @param bool            $debug
     */
    public function __construct(LoggerInterface $logger, $sampled = 1.0, $debug = false)
    {
        $this->logger = $logger;

        $this->sampled = $sampled;
        if ($sampled < 1.0) {
            $this->sampled = ($sampled == 0) ? false : ($sampled > (mt_rand() / mt_getrandmax()));
        }else{

        }
        $this->debug = $debug;
    }

    /**
     * @param Span[] $spans
     */
    public function record(array $spans)
    {
        if ($this->sampled || $this->debug) {
            $this->logger->trace($spans);
        }
    }

    /**
     * @param boolean $debug
     */
    public function setDebug(bool $debug)
    {
        $this->debug = $debug;
    }

    /**
     * @param float $sampled
     * @param bool  $debug
     * @return Tracer
     */
    public static function generateHTTPTracer($sampled = 1.0, $debug = false)
    {
        $client = new Client();
        $logger = new HTTPLogger($client);

        return new self($logger, $sampled, $debug);
    }
}
