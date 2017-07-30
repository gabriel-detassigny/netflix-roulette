<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 30/07/2017
 * Time: 21:38
 */

namespace GabrielDeTassigny\NetflixRoulette\Tests\Show;

use GabrielDeTassigny\NetflixRoulette\Show\Show;
use GabrielDeTassigny\NetflixRoulette\Show\ShowCollection;
use Phake;

class ShowCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testAddOneShow()
    {
        $collection = new ShowCollection();
        $show = Phake::mock(Show::class);

        $collection->addShow($show);

        $this->assertSame($collection->current(), $show);
        $this->assertCount(1, $collection);
        $this->assertTrue($collection->valid());
    }

    public function testAddMultipleShows()
    {
        $collection = new ShowCollection();
        $show1 = Phake::mock(Show::class);
        $show2 = Phake::mock(Show::class);

        $collection->addShow($show1);
        $collection->addShow($show2);

        $this->assertSame($collection->current(), $show1);
        $collection->next();
        $this->assertSame($collection->current(), $show2);
    }

    public function testRewind()
    {
        $collection = new ShowCollection();
        $collection->addShow(Phake::mock(Show::class));
        $collection->addShow(Phake::mock(Show::class));
        $collection->next();

        $this->assertSame(1, $collection->key());

        $collection->rewind();

        $this->assertSame(0, $collection->key());
    }

    public function testValid()
    {
        $collection = new ShowCollection();

        $this->assertFalse($collection->valid());
        $collection->addShow(Phake::mock(Show::class));
        $this->assertTrue($collection->valid());
    }
}
