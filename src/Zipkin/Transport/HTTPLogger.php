<?php
namespace BlackHades\PHPZipkin\Zipkin\Transport;

use BlackHades\PHPZipkin\exceptions\ZipKinException;
use BlackHades\PHPZipkin\Zipkin\Core\Span;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class HTTPLogger implements LoggerInterface
{
    /** @var ClientInterface $client */
    private $client;

    /** @var string $baseUrl */
    private $baseUrl;

    /**
     * @param ClientInterface $client
     * @param string          $baseUrl
     */
    public function __construct(ClientInterface $client, $baseUrl = 'http://localhost:9411/api/v1/spans')
    {
        $this->client  = $client;
        $this->baseUrl = $baseUrl;
        $this->baseUrl = config("zipkin.endpoint_url");
    }

    public function setEndpoint(string $endpoint){
        if(is_null($endpoint))
            throw new \Exception("Endpoint is required");
        $this->baseUrl = $endpoint;
    }
    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->baseUrl;
    }

    /**
     * @param Span[] $spans
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function trace(array $spans)
    {
        $spans =  array_map([$this, 'spanToArray'], $spans);
        try {
            $options = [
                'json' => $spans,
            ];

            $this->client->request('POST', $this->baseUrl, $options);
        } catch (RequestException $e) {
            throw new ZipKinException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param Span $span
     * @return array
     */
    public function spanToArray(Span $span): array
    {
        return $span->toArray();
    }
}
