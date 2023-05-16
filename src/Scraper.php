<?php

namespace Esayers\LaughingSpoon;

use GuzzleHttp\Client;

class Scraper {

    private $client;

    function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Makes a get request with Accept: text/html
     * 
     * @param string $url URL of the webpage to scrape
     * @return string Contents of webpage
     */
    function getPage($url) :string {
        $request = $this->client->get($url, ['Accept' => 'text/html']);
        return $request->getBody()->getContents();
    }
}