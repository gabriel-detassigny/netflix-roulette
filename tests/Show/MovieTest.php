<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 30/07/2017
 * Time: 21:17
 */

namespace GabrielDeTassigny\NetflixRoulette\Tests\Show;

use GabrielDeTassigny\NetflixRoulette\Show\Movie;

class MovieTest extends \PHPUnit_Framework_TestCase
{
    /** Movie */
    private $movie;

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
            'summary' => 'Some random movie',
            'poster' => 'http://example.com/image.jpg',
            'runtime' => '142 min'
        ];
        $this->movie = new Movie($attributes);
    }

    public function testGetId()
    {
        $this->assertSame(1, $this->movie->getId());
    }

    public function testGetNetflixId()
    {
        $this->assertSame(2, $this->movie->getNetflixId());
    }

    public function testGetTitle()
    {
        $this->assertSame('Test', $this->movie->getTitle());
    }

    public function testGetReleaseYear()
    {
        $this->assertSame(1998, $this->movie->getReleaseYear());
    }

    public function testGetRating()
    {
        $this->assertSame(3.5, $this->movie->getRating());
    }

    public function testGetCategory()
    {
        $this->assertSame('science-fiction', $this->movie->getCategory());
    }

    public function testGetCast()
    {
        $this->assertSame('This Guy, That Guy, That Other Guy', $this->movie->getCast());
    }

    public function testGetDirector()
    {
        $this->assertSame('This Dude', $this->movie->getDirector());
    }

    public function testGetSummary()
    {
        $this->assertSame('Some random movie', $this->movie->getSummary());
    }

    public function testGetPosterUrl()
    {
        $this->assertSame('http://example.com/image.jpg', $this->movie->getPosterUrl());
    }

    public function testGetNetflixUrl()
    {
        $this->assertSame('http://www.netflix.com/WiPlayer?movieid=2', $this->movie->getNetflixUrl());
    }

    public function testGetType()
    {
        $this->assertSame('movie', $this->movie->getType());
    }

    public function testGetRuntime()
    {
        $this->assertSame(142, $this->movie->getRuntime());
    }
}
