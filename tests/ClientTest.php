<?php

namespace GabrielDeTassigny\NetflixRoulette\Tests;

use GabrielDeTassigny\NetflixRoulette\Client;
use GuzzleHttp\Client as HttpClient;
use Mockery;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
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
        $this->httpClient = Mockery::mock(HttpClient::class);
        $this->client = new Client($this->httpClient);
    }

    public function testInstantiateClient(): void
    {
        $this->assertInstanceOf(Client::class, $this->client);
    }

    public function testGetStaticInstance(): void
    {
        $this->assertInstanceOf(Client::class, Client::getInstance());
    }
}
