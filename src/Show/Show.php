<?php

namespace GabrielDeTassigny\NetflixRoulette\Show;

interface Show
{
    const NETFLIX_BASE_URL = 'http://www.netflix.com/WiPlayer?movieid=';

    public function getId(): int;
    public function getNetflixId(): int;
    public function getTitle(): string;
    public function getReleaseYear(): int;
    public function getRating(): float;
    public function getCategory(): string;
    public function getCast(): string;
    public function getDirector(): string;
    public function getSummary(): string;
    public function getPosterUrl(): string;
    public function getNetflixUrl(): string;
    public function getType(): string;
    public function getRuntime(): int;
}
