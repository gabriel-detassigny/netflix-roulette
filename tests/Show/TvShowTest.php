<?php

namespace GabrielDeTassigny\NetflixRoulette\Tests\Show;

use PHPUnit_Framework_TestCase;
use GabrielDeTassigny\NetflixRoulette\Show\TvShow;

class TvShowTest extends PHPUnit_Framework_TestCase
{
    /** TvShow */
    private $tvShow;

    public function setUp()
    {
        $attributes = [
            'unit' => 1,
            'show_id' => 2,
            'show_title' => 'Test',
            'release_year' => '1998',
            'rating' => '3.5',
            'category' => 'science-fiction',
            'show_cast' => 'This Guy, That Guy, That Other Guy',
            'director' => 'This Dude',
            'summary' => 'Some random show',
            'poster' => 'http://example.com/image.jpg',
            'runtime' => '42 min'
        ];
        $this->tvShow = new TvShow($attributes);
    }

    public function testGetId()
    {
        $this->assertSame(1, $this->tvShow->getId());
    }

    public function testGetNetflixId()
    {
        $this->assertSame(2, $this->tvShow->getNetflixId());
    }

    public function testGetTitle()
    {
        $this->assertSame('Test', $this->tvShow->getTitle());
    }

    public function testGetReleaseYear()
    {
        $this->assertSame(1998, $this->tvShow->getReleaseYear());
    }

    public function testGetRating()
    {
        $this->assertSame(3.5, $this->tvShow->getRating());
    }

    public function testGetCategory()
    {
        $this->assertSame('science-fiction', $this->tvShow->getCategory());
    }

    public function testGetCast()
    {
        $this->assertSame('This Guy, That Guy, That Other Guy', $this->tvShow->getCast());
    }

    public function testGetDirector()
    {
        $this->assertSame('This Dude', $this->tvShow->getDirector());
    }

    public function testGetSummary()
    {
        $this->assertSame('Some random show', $this->tvShow->getSummary());
    }

    public function testGetPosterUrl()
    {
        $this->assertSame('http://example.com/image.jpg', $this->tvShow->getPosterUrl());
    }

    public function testGetNetflixUrl()
    {
        $this->assertSame('http://www.netflix.com/WiPlayer?movieid=2', $this->tvShow->getNetflixUrl());
    }

    public function testGetType()
    {
        $this->assertSame('tv-show', $this->tvShow->getType());
    }

    public function testGetRuntime()
    {
        $this->assertSame(42, $this->tvShow->getRuntime());
    }
}
