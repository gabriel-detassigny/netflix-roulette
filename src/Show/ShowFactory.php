<?php

namespace GabrielDeTassigny\NetflixRoulette\Show;

use GabrielDeTassigny\NetflixRoulette\Exception\ApiErrorException;

class ShowFactory
{
    const TYPE_KEY = 'mediatype';

    /**
     * @param array $showAttributes
     * @return Show
     * @throws ApiErrorException
     */
    public function getShow(array $showAttributes): Show
    {
        switch ($showAttributes[self::TYPE_KEY]) {
            case 0:
                return new Movie($showAttributes);
            case 1:
                return new TvShow($showAttributes);
            default:
                throw new ApiErrorException('Wrong type returned by the API');
        }
    }

    /**
     * @param array $shows
     * @return ShowCollection
     * @throws ApiErrorException
     */
    public function getShowCollection(array $shows): ShowCollection
    {
        $collection = new ShowCollection();

        foreach ($shows as $showAttributes) {
            $collection->addShow($this->getShow($showAttributes));
        }

        return $collection;
    }
}
