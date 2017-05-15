<?php

namespace GabrielDeTassigny\NetflixRoulette\Tests\Show;

use Phake;
use PHPUnit_Framework_TestCase;
use GabrielDeTassigny\NetflixRoulette\Show\ShowFactory;
use GabrielDeTassigny\NetflixRoulette\Show\Show;
use GabrielDeTassigny\NetflixRoulette\Show\TvShow;

class ShowFactoryTest extends PHPUnit_Framework_TestCase
{
    /** ShowFactory */
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

    /**
     * @expectedException \GabrielDeTassigny\NetflixRoulette\Exception\ApiErrorException
     */
    public function testInvalidType()
    {
        $attributes = $this->getAttributes(42);
        $this->factory->getShow($attributes);
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
