# Tmdb - PHP Wrapper for The Movie Database API V3

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/6bf2cf4c-4b74-4a06-a5ca-afcc259df86e/big.png)](https://insight.sensiolabs.com/projects/6bf2cf4c-4b74-4a06-a5ca-afcc259df86e)

[![Latest Stable Version](https://poser.pugx.org/vfalies/tmdb/version)](https://packagist.org/packages/vfalies/tmdb) [![Build Status](https://scrutinizer-ci.com/g/vfalies/tmdb/badges/build.png?b=master)](https://scrutinizer-ci.com/g/vfalies/tmdb/build-status/master) [![Code Coverage](https://scrutinizer-ci.com/g/vfalies/tmdb/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/vfalies/tmdb/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/vfalies/tmdb/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/vfalies/tmdb/?branch=master) [![PHP Tested](https://php-eye.com/badge/vfalies/tmdb/tested.svg)](https://php-eye.com/package/vfalies/tmdb) [![Dependency Status](https://www.versioneye.com/user/projects/59315b3680def100433e5fc4/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/59315b3680def100433e5fc4) [![License](https://poser.pugx.org/vfalies/tmdb/license)](https://packagist.org/packages/vfalies/tmdb)

Tmdb is a PHP wrapper for [The Movie Database](https://www.themoviedb.org/) API [V3](https://developers.themoviedb.org).

Features actualy supported :

- Search
  - Movie
  - TV Show
  - Collection
  - Company
- Getting informations
  - Movie
  - TV Show
  - Collection
  - Company
  - Genres
- Account
  - Authentification
  - Movies / TV Shows rating
  - Movies / TV Shows favorites
  - Movies / TV Shows watchlist
- Media
- Genres
- Jobs


## Installation

Install the lastest version with

```bash
$ composer require vfalies/tmdb
```

## Basic Usage

```php
<?php

require 'vendor/autoload.php';

use VfacTmdb\Factory;
use VfacTmdb\Search;
use VfacTmdb\Item;

// Initialize Wrapper
$tmdb = Factory::create()->getTmdb('your_api_key');

// Search a movie
$search    = new Search($tmdb);
$responses = $search->movie('star wars');

// Get all results
foreach ($responses as $response)
{
    echo $response->getTitle();
}

// Get movie information
$item  = new Item($tmdb);
$infos = $item->getMovie(11, array('language' => 'fr-FR'));

echo $infos->getTitle();
```

The destination of the generation is `docs/` repository.

## Unit Testing

You can run the unit test suites using the following command in the library's source directory:

```
$ make test
```

## About

### Requirements

- Tmdb works with PHP 7.1 and higher
- TheMovieDatabase API key

### Submitting bugs and feature requests

Bugs and feature request are tracked on [GitHub](https://github.com/vfalies/tmdb/issues)

### Author

Vincent Faliès - <vincent@vfac.fr>

### License

VfacTmdb is licensed under the MIT License - see the `LICENSE` file for details
