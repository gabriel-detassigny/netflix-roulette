<?php

namespace GabrielDeTassigny\NetflixRoulette\Show;

use Countable;
use Iterator;

class ShowCollection implements Iterator, Countable
{
    /** @var array */
    private $shows = [];

    /**
     * @param Show $show
     * @return void
     */
    public function addShow(Show $show): void
    {
        $this->shows[] = $show;
    }

    /**
     * @return Show|false
     */
    public function current()
    {
        return current($this->shows);
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        next($this->shows);
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return key($this->shows);
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return (isset($this->shows[$this->key()]));
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        reset($this->shows);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->shows);
    }
}