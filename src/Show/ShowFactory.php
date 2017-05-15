<?php

namespace GabrielDeTassigny\NetflixRoulette\Show;

use GabrielDeTassigny\NetflixRoulette\Exception\ApiErrorException;

class ShowFactory
{
    public function getShow(array $showAttributes): Show
    {
        switch ($showAttributes['mediatype']) {
            case 1:
                return new TvShow($showAttributes);
            default:
                throw new ApiErrorException('Wrong type returned by the API');
        }
    }
}
