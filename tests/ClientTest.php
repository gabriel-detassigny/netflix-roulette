<?php

namespace GabrielDeTassigny\NetflixRoulette\Tests;

use GabrielDeTassigny\NetflixRoulette\Client;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;
use Phake;
use PHPUnit_Framework_TestCase;

class ClientTest extends PHPUnit_Framework_TestCase
{
    /** @var Client */
    private $client;

    /** @var HttpClient */
    private $httpClient;

    /** @var Response */
    private $response;

    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        $this->httpClient = Phake::mock(HttpClient::class);

        $this->response = Phake::mock(Response::class);
        Phake::when($this->response)->getStatusCode()->thenReturn(200);
        Phake::when($this->httpClient)->request(Phake::anyParameters())->thenReturn($this->response);

        $this->client = new Client($this->httpClient);
    }

    public function testGetWithoutParameters(): void
    {
        $this->client->get();

        Phake::verify($this->httpClient)->request('GET', Client::API_BASE_URL, ['query' => []]);
    }

    /**
     * @expectedException \GabrielDeTassigny\NetflixRoulette\Exception\ApiErrorException
     * @expectedExceptionCode 500
     */
    public function testInternalServerError(): void
    {
        Phake::when($this->response)->getStatusCode()->thenReturn(500);
        Phake::when($this->response)->getReasonPhrase()->thenReturn('Internal Server Error');

        $this->client->get();
    }

    public function testGetStaticInstance(): void
    {
        $this->assertInstanceOf(Client::class, Client::getInstance());
    }
}
