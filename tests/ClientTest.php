<?php

namespace GabrielDeTassigny\NetflixRoulette\Tests;

use GabrielDeTassigny\NetflixRoulette\Client;
use GabrielDeTassigny\NetflixRoulette\Show\ShowCollection;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;
use Phake;
use PHPUnit_Framework_TestCase;
use Psr\Http\Message\StreamInterface;
use GabrielDeTassigny\NetflixRoulette\Show\ShowFactory;
use GabrielDeTassigny\NetflixRoulette\Show\Show;

class ClientTest extends PHPUnit_Framework_TestCase
{
    /** @var StreamInterface */
    private $stream;

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
        $this->stream = Phake::mock(StreamInterface::class);
        Phake::when($this->stream)->getContents()->thenReturn('[]');
        Phake::when($this->response)->getBody()->thenReturn($this->stream);

        Phake::when($this->showFactory)->getShow(Phake::anyParameters())
            ->thenReturn(Phake::mock(Show::class));
        Phake::when($this->showFactory)->getShowCollection(Phake::anyParameters())
            ->thenReturn(Phake::mock(ShowCollection::class));
        $this->client = new Client($this->httpClient, $this->showFactory);
    }

    public function testFindOne(): void
    {
        $result = $this->client->findOne([]);

        Phake::verify($this->httpClient)->request(
            'GET',
            'http://netflixroulette.net/api/api.php',
            ['query' => []]
        );
        $this->assertInstanceOf(Show::class, $result);
    }

    public function testFindOneAmongMany(): void
    {
        Phake::when($this->stream)->getContents()->thenReturn('[{"mediatype":1},{"mediatype":2}]');

        $this->client->findOne([]);

        Phake::verify($this->showFactory)->getShow(['mediatype' => 1]);
    }

    public function testFindManyWithSingleResponseObject(): void
    {
        Phake::when($this->stream)->getContents()->thenReturn('{"mediatype":1}');
        $result = $this->client->findMany(['film' => 'Pulp Fiction']);

        Phake::verify($this->httpClient)->request(
            'GET',
            'http://netflixroulette.net/api/api.php',
            ['query' => ['film' => 'Pulp Fiction']]
        );
        Phake::verify($this->showFactory)->getShowCollection([['mediatype' => 1]]);
        $this->assertInstanceOf(ShowCollection::class, $result);
    }

    public function testFindManyWithManyResponseObjects()
    {
        Phake::when($this->stream)->getContents()->thenReturn('[{"mediatype":1},{"mediatype":2}]');
        $result = $this->client->findMany(['actor' => 'Edward Norton']);

        Phake::verify($this->showFactory)->getShowCollection([['mediatype' => 1], ['mediatype' => 2]]);
        $this->assertInstanceOf(ShowCollection::class, $result);
    }

    /**
     * @expectedException \GabrielDeTassigny\NetflixRoulette\Exception\ApiErrorException
     * @expectedExceptionCode 500
     */
    public function testInternalServerError(): void
    {
        Phake::when($this->response)->getStatusCode()->thenReturn(500);
        Phake::when($this->response)->getReasonPhrase()->thenReturn('Internal Server Error');

        $this->client->findOne([]);
    }

    /**
     * @expectedException \GabrielDeTassigny\NetflixRoulette\Exception\ClientErrorException
     * @expectedExceptionCode 400
     */
    public function testClientError(): void
    {
        Phake::when($this->response)->getStatusCode()->thenReturn(400);
        Phake::when($this->response)->getReasonPhrase()->thenReturn('Bad Request');

        $this->client->findOne([]);
    }

    public function testGetStaticInstance(): void
    {
        $this->assertInstanceOf(Client::class, Client::getInstance());
    }
}
