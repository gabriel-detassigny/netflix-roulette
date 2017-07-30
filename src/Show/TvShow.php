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

    /**
     * @param array $attributes
     */
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

    /**
     * {@inheritdoc}
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getNetflixId(): int
    {
        return $this->netflixId;
    }

    /**
     * {@inheritdoc}
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * {@inheritdoc}
     */
    public function getReleaseYear(): int
    {
        return $this->releaseYear;
    }

    /**
     * {@inheritdoc}
     */
    public function getRating(): float
    {
        return $this->rating;
    }

    /**
     * {@inheritdoc}
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * {@inheritdoc}
     */
    public function getCast(): string
    {
        return $this->cast;
    }

    /**
     * {@inheritdoc}
     */
    public function getDirector(): string
    {
        return $this->director;
    }

    /**
     * {@inheritdoc}
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosterUrl(): string
    {
        return $this->posterUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function getNetflixUrl(): string
    {
        return $this->netflixUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function getType(): string
    {
        return self::TYPE;
    }

    /**
     * {@inheritdoc}
     */
    public function getRuntime(): int
    {
        return $this->runtime;
    }
}
