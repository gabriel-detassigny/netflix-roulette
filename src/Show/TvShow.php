<?php

namespace GabrielDeTassigny\NetflixRoulette\Show;

class TvShow implements Show
{
    private const TYPE = 'tv-show';

    private $id;
    private $netflixId;
    private $title;
    private $releaseYear;
    private $rating;
    private $category;
    private $cast;
    private $director;
    private $summary;
    private $posterUrl;
    private $netflixUrl;
    private $runtime;

    public function __construct(array $attributes)
    {
        $this->id = $attributes['unit'];
        $this->netflixId = $attributes['show_id'];
        $this->title = $attributes['show_title'];
        $this->releaseYear = (int) $attributes['release_year'];
        $this->rating = (float) $attributes['rating'];
        $this->category = $attributes['category'];
        $this->cast = $attributes['show_cast'];
        $this->director = $attributes['director'];
        $this->summary = $attributes['summary'];
        $this->posterUrl = $attributes['poster'];
        $this->netflixUrl = self::NETFLIX_BASE_URL . $this->getNetflixId();
        $this->runtime = (int) $attributes['runtime'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNetflixId(): int
    {
        return $this->netflixId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getReleaseYear(): int
    {
        return $this->releaseYear;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function getCast(): string
    {
        return $this->cast;
    }

    public function getDirector(): string
    {
        return $this->director;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function getPosterUrl(): string
    {
        return $this->posterUrl;
    }

    public function getNetflixUrl(): string
    {
        return $this->netflixUrl;
    }

    public function getType(): int
    {
        return self::TYPE;
    }

    public function getRuntime(): int
    {
        return $this->runtime;
    }
}
