# netflix-roulette

## Please Note!!

Netflix roulette API is now down, therefore this package won't work anymore!

[![Build Status](https://travis-ci.org/gabriel-detassigny/netflix-roulette.svg?branch=master)](https://travis-ci.org/gabriel-detassigny/netflix-roulette)

[![Coverage Status](https://coveralls.io/repos/github/gabriel-detassigny/netflix-roulette/badge.svg?branch=master)](https://coveralls.io/github/gabriel-detassigny/netflix-roulette?branch=master)


This is an unofficial PHP wrapper for the [Netflix Roulette API](https://netflixroulette.net/api/).

## Installation

You can install this wrapper by using composer.

Simply type :
```
composer require gdetassigny/netflix-roulette
```

## Usage

The API should allow you to retrieve movies and tv shows for given parameters.
(e.g. retrieve all netflix movies starring Brad Pitt).

Here is an example of how you could use this wrapper :
```php

use GabrielDeTassigny\NetflixRoulette\Client;

$client = Client::getInstance();

$show = $client->findOne(['title' => 'Breaking Bad']);

var_dump($show->getSummary());
// "Emmy winner Bryan Cranston stars as Walter White, a high school science teacher who learns..."

$showList = $client->findMany(['actor' => 'Edward Norton']);

foreach ($showList as $show) {
    var_dump($show->getTitle());
}
// "The Italian Job"
// "The Score"
// "Strange Days on Planet Earth"
// "Primal Fear"
// "Rounders"
// "Frida"
```

You can see more example of parameters in the [API documentation](https://netflixroulette.net/api/).

To see what information you can retrieve for movies / shows, have a look at [the interface](https://github.com/gabriel-detassigny/netflix-roulette/blob/master/src/Show/Show.php).
