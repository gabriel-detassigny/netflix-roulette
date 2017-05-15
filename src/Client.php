<?php

namespace GabrielDeTassigny\NetflixRoulette;

use GabrielDeTassigny\NetflixRoulette\Exception\ApiErrorException;
use GabrielDeTassigny\NetflixRoulette\Exception\ClientErrorException;
use GuzzleHttp\Client as HttpClient;
use Psr\Http\Message\ResponseInterface;
use GabrielDeTassigny\NetflixRoulette\Show\Show;
use GabrielDeTassigny\NetflixRoulette\Show\ShowFactory;

class Client
{
    private const API_BASE_URL = 'http://netflixroulette.net/api/api.php';

    private $httpClient;
    private $showFactory;

    public function __construct(HttpClient $httpClient, ShowFactory $showFactory)
    {
        $this->httpClient = $httpClient;
        $this->showFactory = $showFactory;
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
        $responseContent = $this->getFormattedResponse($response);
        
        return $this->showFactory->getShow($responseContent);
    }

    public static function getInstance(): self
    {
        return new self(
            new HttpClient(['base_uri' => self::API_BASE_URL]),
            new ShowFactory()
        );
    }

    private function getFormattedResponse(ResponseInterface $response): array
    {
        $rawResponse = $response->getBody()->getContents();

        return json_decode($rawResponse, true);
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
