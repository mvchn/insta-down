<?php

namespace App\Client;

use App\Exception\BadInstagramResponseException;
use Http\Client\Common\HttpMethodsClient;
use Http\Client\HttpClient;

class InstagramHttpClient
{
    /** @var HttpMethodsClient  */
    private $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $uri
     * @return array
     * @throws \Http\Client\Exception
     * @throws BadInstagramResponseException
     */
    public function getData(string $uri): array
    {
        $resp = $this->httpClient->get($uri) ;

        if (200 === $resp->getStatusCode()) {
            return json_decode($resp->getBody()->getContents(), true);
        }

        throw new BadInstagramResponseException("Invalid url");

    }
}