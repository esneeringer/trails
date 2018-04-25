<?php

namespace App\Services;

use GuzzleHttp\Client;

class GuzzleApi {

    protected $client;

    public function guzzleRequest($method, $url, $options)
    {
        // Create instance of Guzzle Client
        $this->client = new Client();

        // Send request and store response
        $response = $this->client->request($method, $url, $options);

        return $response;
    } // guzzleRequest
}