<?php

namespace Asgard\Support\ESI;

use GuzzleHttp\Client;

class Token {

    protected $httpClient;
    protected $refreshToken;

    public function __construct(string $refeshToken, Client $httpClient)
    {
        $this->httpClient = $httpClient;
        $this->refreshToken = $refeshToken;
    }


}