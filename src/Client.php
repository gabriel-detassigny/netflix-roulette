<?php

namespace GabrielDeTassigny\NetflixRoulette;

use GuzzleHttp\Client as HttpClient;

class Client
{
    const API_BASE_URL = 'http://netflixroulette.net/api/api.php';

    /** @var HttpClient */
    private $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public static function getInstance(): self
    {
        return new self(new HttpClient(array('base_uri' => self::API_BASE_URL)));
    }
}