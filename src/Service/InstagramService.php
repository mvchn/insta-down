<?php

namespace App\Service;

use App\Client\InstagramHttpClient;
use App\Exception\BadInstagramResponseException;

class InstagramService
{
    /** @var InstagramHttpClient */
    private $client;

    public function __construct(InstagramHttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $uri
     * @throws \Http\Client\Exception
     * @throws BadInstagramResponseException
     *
     * @return string
     */
    public function getBigImageByUrl(string $uri): string 
    {
        $result = $this->client->getData($this->getJsonUri($uri));

        if(!isset($result['graphql']['shortcode_media']['display_resources'][2]['src'])) {
            throw new BadInstagramResponseException("No download content in response");
        }

        return $this->getDownloadUri($result['graphql']['shortcode_media']['display_resources'][2]['src']);
    }

    /**
     * @param string $uri
     * @return string
     */
    public function getJsonUri(string $uri) : string
    {
        return $uri . '?' . http_build_query(['__a'=> 1]);
    }

    /**
     * @param string $uri
     * @return string
     */
    public function getDownloadUri(string $uri) : string
    {
        return $uri . '&' . http_build_query(['dl'=> 1]);
    }
}
