<?php

namespace App\Service;

use Http\Client\HttpClient;
use Http\Message\RequestFactory;
use Symfony\Component\DomCrawler\Crawler;

class InstagramService
{
    private $requestFactory;

    private $httpClient;

    public function __construct(RequestFactory $requestFactory, HttpClient $httpClient)
    {
        $this->requestFactory = $requestFactory;
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $url
     * @throws \Http\Client\Exception
     *
     * @return string
     */
    public function getBigImageByUrl(string $url)
    {
        $httpRequest = $this->requestFactory->createRequest('get', $url);
        $resp = $this->httpClient->sendRequest($httpRequest);
        $crawler = new Crawler($resp->getBody()->getContents());
        $data = $crawler->filterXpath("//meta[@property='og:image']")->extract(['content']);

        return $data[0];
    }
}
