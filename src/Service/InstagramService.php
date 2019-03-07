<?php

namespace App\Service;

use App\Client\InstagramHttpClient;

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
     *
     * @return string
     */
    public function getBigImageByUrl(string $uri)
    {
        $result = $this->client->get($this->getJsonUri($uri));

        if(property_exists( $result, 'graphql') &&
            property_exists($result->graphql, 'shortcode_media') &&
            property_exists($result->graphql->shortcode_media, 'display_resources')) {
            $imageUrl =  $result->graphql->shortcode_media->display_resources[2]->src;
        }  else {
            return null;
        }
        
        return $this->getDownloadUri($imageUrl) ;
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
