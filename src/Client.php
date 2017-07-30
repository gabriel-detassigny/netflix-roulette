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

    /**
     * @param HttpClient $httpClient
     * @param ShowFactory $showFactory
     */
    public function __construct(HttpClient $httpClient, ShowFactory $showFactory)
    {
        $this->httpClient = $httpClient;
        $this->showFactory = $showFactory;
    }

    /**
     * @param array $parameters
     * @return Show
     * @throws ApiErrorException
     * @throws ClientErrorException
     */
    public function get(array $parameters = []): Show
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

    /**
     * @return self
     */
    public static function getInstance(): self
    {
        return new self(
            new HttpClient(['base_uri' => self::API_BASE_URL]),
            new ShowFactory()
        );
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    private function getFormattedResponse(ResponseInterface $response): array
    {
        $rawResponse = $response->getBody()->getContents();

        return json_decode($rawResponse, true);
    }

    /**
     * @param int $status
     * @return bool
     */
    private function isServerError(int $status): bool
    {
        return ($status >= 500);
    }

    /**
     * @param int $status
     * @return bool
     */
    private function isClientError(int $status): bool
    {
        return ($status >= 400 && $status < 500);
    }
}
