<?php

namespace GabrielDeTassigny\NetflixRoulette\Show;

interface Show
{
    const NETFLIX_BASE_URL = 'http://www.netflix.com/WiPlayer?movieid=';

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return int
     */
    public function getNetflixId(): int;

    /**
     * @return string
     */
    public function getTitle(): string;

    /**
     * @return int
     */
    public function getReleaseYear(): int;

    /**
     * @return float
     */
    public function getRating(): float;

    /**
     * @return string
     */
    public function getCategory(): string;

    /**
     * @return string
     */
    public function getCast(): string;

    /**
     * @return string
     */
    public function getDirector(): string;

    /**
     * @return string
     */
    public function getSummary(): string;

    /**
     * @return string
     */
    public function getPosterUrl(): string;

    /**
     * @return string
     */
    public function getNetflixUrl(): string;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return int
     */
    public function getRuntime(): int;
}
