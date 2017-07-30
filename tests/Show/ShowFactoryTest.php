<?php

namespace GabrielDeTassigny\NetflixRoulette\Tests\Show;

use GabrielDeTassigny\NetflixRoulette\Show\Movie;
use GabrielDeTassigny\NetflixRoulette\Show\ShowCollection;
use PHPUnit_Framework_TestCase;
use GabrielDeTassigny\NetflixRoulette\Show\ShowFactory;
use GabrielDeTassigny\NetflixRoulette\Show\TvShow;

class ShowFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var ShowFactory */
    private $factory;

    public function setUp()
    {
        $this->factory = new ShowFactory();
    }

    public function testGetTvShow()
    {
        $attributes = $this->getAttributes(1);
        $tvShow = $this->factory->getShow($attributes);

        $this->assertInstanceOf(TvShow::class, $tvShow);
    }

    public function testGetMovie()
    {
        $attributes = $this->getAttributes(2);
        $movie = $this->factory->getShow($attributes);

        $this->assertInstanceOf(Movie::class, $movie);
    }

    /**
     * @expectedException \GabrielDeTassigny\NetflixRoulette\Exception\ApiErrorException
     */
    public function testInvalidType()
    {
        $attributes = $this->getAttributes(42);
        $this->factory->getShow($attributes);
    }

    public function testGetShowCollection()
    {
        $shows = [
            $this->getAttributes(1),
            $this->getAttributes(2)
        ];
        $collection = $this->factory->getShowCollection($shows);

        $this->assertInstanceOf(ShowCollection::class, $collection);
    }

    private function getAttributes($mediaType): array
    {
        return [
            'unit' => 1,
            'show_id' => 1,
            'show_title' => 'Test',
            'release_year' => '1998',
            'rating' => '3.5',
            'category' => 'science-fiction',
            'show_cast' => 'This Guy, That Guy, That Other Guy',
            'director' => 'This Dude',
            'summary' => 'Some random show',
            'poster' => 'http://example.com/image.jpg',
            'mediatype' => $mediaType,
            'runtime' => '42 min'
        ];
    }
}
