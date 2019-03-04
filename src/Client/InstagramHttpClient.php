<?php

namespace App\Client;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\HttpClient;
use Http\Message\RequestFactory;

class InstagramHttpClient
{
    private $requestFactory;

    /** @var HttpMethodsClient  */
    private $httpClient;

    public function __construct(RequestFactory $requestFactory, HttpClient $httpClient)
    {
        $this->requestFactory = $requestFactory;
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $uri
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Http\Client\Exception
     */
    public function get(string $uri)
    {
        return $this->httpClient->get($uri);
    }
}