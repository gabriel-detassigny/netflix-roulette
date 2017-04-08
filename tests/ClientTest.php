<?php

namespace GabrielDeTassigny\NetflixRoulette\Tests;

use GabrielDeTassigny\NetflixRoulette\Client;
use GuzzleHttp\Client as HttpClient;
use Phake;
use PHPUnit_Framework_TestCase;

class ClientTest extends PHPUnit_Framework_TestCase
{
    /** @var Client */
    private $client;

    /** @var HttpClient */
    private $httpClient;

    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        $this->httpClient = Phake::mock(HttpClient::class);
        $this->client = new Client($this->httpClient);
    }

    public function testGetWithoutParameters(): void
    {
        $this->client->get();

        Phake::verify($this->httpClient)->request('GET', Client::API_BASE_URL, ['query' => []]);
    }

    public function testGetStaticInstance(): void
    {
        $this->assertInstanceOf(Client::class, Client::getInstance());
    }
}
