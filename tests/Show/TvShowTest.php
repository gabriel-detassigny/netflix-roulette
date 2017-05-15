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
}
