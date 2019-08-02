<?php

use Drefined\Zipkin\Transport\HTTPLogger;
use GuzzleHttp\Client;

class HTTPLoggerTest extends \PHPUnit\Framework\TestCase
{
    public function testDefaultEndpoint()
    {
        $client = new Client();
        $httpLogger = new HTTPLogger($client);

        $endpoint = "http://sfsinvest.atp-sevas.com:9411/api/v1/spans";
        $httpLogger->setEndpoint($endpoint);
        var_dump($httpLogger->getEndpoint());
        $this->assertEquals($endpoint, $httpLogger->getEndpoint());
    }
}
