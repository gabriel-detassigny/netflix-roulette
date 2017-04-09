<?php

namespace GabrielDeTassigny\NetflixRoulette;

use GabrielDeTassigny\NetflixRoulette\Exception\ApiErrorException;
use GabrielDeTassigny\NetflixRoulette\Exception\ClientErrorException;
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

    public function get(array $parameters = [])
    {
        $response = $this->httpClient->request('GET', self::API_BASE_URL, ['query' => $parameters]);
        if ($this->isServerError($response->getStatusCode())) {
            throw new ApiErrorException($response->getReasonPhrase(), $response->getStatusCode());
        }
        if ($this->isClientError($response->getStatusCode())) {
            throw new ClientErrorException($response->getReasonPhrase(), $response->getStatusCode());
        }
        return $response->getBody();
    }

    public static function getInstance(): self
    {
        return new self(new HttpClient(['base_uri' => self::API_BASE_URL]));
    }

    private function isServerError(int $status): bool
    {
        return ($status >= 500);
    }

    private function isClientError(int $status): bool
    {
        return ($status >= 400 && $status < 500);
    }
}