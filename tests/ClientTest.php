<?php

namespace GabrielDeTassigny\NetflixRoulette\Tests;

use GabrielDeTassigny\NetflixRoulette\Client;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;
use Phake;
use PHPUnit_Framework_TestCase;
use Psr\Http\Message\StreamInterface;
use GabrielDeTassigny\NetflixRoulette\Show\ShowFactory;
use GabrielDeTassigny\NetflixRoulette\Show\Show;

class ClientTest extends PHPUnit_Framework_TestCase
{
    /** @var Client */
    private $client;

    /** @var HttpClient */
    private $httpClient;

    /** @var Response */
    private $response;

    /** @var ShowFactory */
    private $showFactory;

    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        $this->httpClient = Phake::mock(HttpClient::class);
        $this->showFactory = Phake::mock(ShowFactory::class);

        $this->response = Phake::mock(Response::class);
        Phake::when($this->response)->getStatusCode()->thenReturn(200);
        Phake::when($this->httpClient)->request(Phake::anyParameters())->thenReturn($this->response);
        $stream = Phake::mock(StreamInterface::class);
        Phake::when($stream)->getContents()->thenReturn('[]');
        Phake::when($this->response)->getBody()->thenReturn($stream);
        Phake::when($this->showFactory)->getShow(Phake::anyParameters())
            ->thenReturn(Phake::mock(Show::class));
        $this->client = new Client($this->httpClient, $this->showFactory);
    }

    public function testGetWithoutParameters(): void
    {
        $result = $this->client->get();

        Phake::verify($this->httpClient)->request(
            'GET',
            'http://netflixroulette.net/api/api.php',
            ['query' => []]
        );
        $this->assertInstanceOf(Show::class, $result);
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

    /**
     * @expectedException \GabrielDeTassigny\NetflixRoulette\Exception\ClientErrorException
     * @expectedExceptionCode 400
     */
    public function testClientError(): void
    {
        Phake::when($this->response)->getStatusCode()->thenReturn(400);
        Phake::when($this->response)->getReasonPhrase()->thenReturn('Bad Request');

        $this->client->get();
    }

    public function testGetStaticInstance(): void
    {
        $this->assertInstanceOf(Client::class, Client::getInstance());
    }
}
