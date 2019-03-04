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
        $url .= '?'. http_build_query(['__a'=> 1], null, '&');
        $httpRequest = $this->requestFactory->createRequest('get', $url);
        $resp = $this->httpClient->sendRequest($httpRequest);
        $result = json_decode($resp->getBody()->getContents());

        if(property_exists( $result, 'graphql') &&
            property_exists($result->graphql, 'shortcode_media') &&
            property_exists($result->graphql->shortcode_media, 'display_resources')) {
            $imageUrl =  $result->graphql->shortcode_media->display_resources[2]->src;
        }  else {
            return null;
        }
        $imageUrl .= '&'.http_build_query(['dl'=> 1], null, '&');
        return $imageUrl ;
    }
}
