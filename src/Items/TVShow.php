<?php
/**
 * This file is part of the Tmdb package.
 *
 * (c) Vincent Faliès <vincent@vfac.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Vincent Faliès <vincent@vfac.fr>
 * @copyright Copyright (c) 2017
 */


namespace VfacTmdb\Items;

use VfacTmdb\Abstracts\Item;
use VfacTmdb\Interfaces\Items\TVShowInterface;
use VfacTmdb\Traits\ElementTrait;
use VfacTmdb\Interfaces\TmdbInterface;
use VfacTmdb\Results;

/**
 * TVShow class
 * @package Tmdb
 * @author Vincent Faliès <vincent@vfac.fr>
 * @copyright Copyright (c) 2017
 */
class TVShow extends Item implements TVShowInterface
{
    use ElementTrait;

    /**
     * Constructor
     * @param TmdbInterface $tmdb
     * @param int $tv_id
     * @param array $options
     */
    public function __construct(TmdbInterface $tmdb, int $tv_id, array $options = array())
    {
        parent::__construct($tmdb, $tv_id, $options, 'tv');
    }

    /**
     * Get TV show id
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get TVSHow genres
     * @return array
     */
    public function getGenres() : array
    {
        if (isset($this->data->genres)) {
            return $this->data->genres;
        }
        return [];
    }

    /**
     * Get TVshow note
     *  @return float
     */
    public function getNote() : float
    {
        if (isset($this->data->vote_average)) {
            return $this->data->vote_average;
        }
        return 0;
    }

    /**
     * Get TVshow number of episodes
     * @return int
     */
    public function getNumberEpisodes() : int
    {
        if (isset($this->data->number_of_episodes)) {
            return $this->data->number_of_episodes;
        }
        return 0;
    }

    /**
     * Get TVShow number of seasons
     * @return int
     */
    public function getNumberSeasons() : int
    {
        if (isset($this->data->number_of_seasons)) {
            return $this->data->number_of_seasons;
        }
        return 0;
    }

    /**
     * Get TVShow original title
     * @return string
     */
    public function getOriginalTitle() : string
    {
        if (isset($this->data->original_name)) {
            return $this->data->original_name;
        }
        return '';
    }

    /**
     * Get TVShow overview
     * @return string
     */
    public function getOverview() : string
    {
        if (isset($this->data->overview)) {
            return $this->data->overview;
        }
        return '';
    }

    /**
     * Get TVShow release date
     * @return string
     */
    public function getReleaseDate() : string
    {
        if (isset($this->data->first_air_date)) {
            return $this->data->first_air_date;
        }
        return '';
    }

    /**
     * Get TVShow status
     * @return string
     */
    public function getStatus() : string
    {
        if (isset($this->data->status)) {
            return $this->data->status;
        }
        return '';
    }

    /**
     * Get TVShow title
     * @return string
     */
    public function getTitle() : string
    {
        if (isset($this->data->name)) {
            return $this->data->name;
        }
        return '';
    }

    /**
     * Get TVShow seasons
     * @return \Generator|Results\TVSeason
     */
    public function getSeasons() : \Generator
    {
        if (!empty($this->data->seasons)) {
            foreach ($this->data->seasons as $season) {
                $season = new Results\TVSeason($this->tmdb, $season);
                yield $season;
            }
        }
    }

    /**
     * Get TVShow networks
     * @return \Generator|\stdClass
     */
    public function getNetworks() : \Generator
    {
        if (!empty($this->data->networks)) {
            foreach ($this->data->networks as $network) {
                $n       = new \stdClass();
                $n->id   = $network->id;
                $n->name = $network->name;

                yield $n;
            }
        }
    }

    /**
     * Backdrops list
     * @return \Generator|Results\Image
     */
    public function getBackdrops() : \Generator
    {
        $data = $this->tmdb->getRequest('/tv/' . (int) $this->id . '/images', $this->params);

        foreach ($data->backdrops as $b) {
            $image = new Results\Image($this->tmdb, $this->id, $b);
            yield $image;
        }
    }

    /**
     * Posters list
     * @return \Generator|Results\Image
     */
    public function getPosters() : \Generator
    {
        $data = $this->tmdb->getRequest('/tv/' . (int) $this->id . '/images', $this->params);

        foreach ($data->posters as $b) {
            $image = new Results\Image($this->tmdb, $this->id, $b);
            yield $image;
        }
    }

    /**
     * Get Similar TVShow
     * @return \Generator|Results\TVShow
     */
    public function getSimilar() : \Generator
    {
        $similar = $this->tmdb->getRequest('/tv/' . (int) $this->id . '/similar', $this->params);

        foreach ($similar->results as $t) {
            $tvshow = new Results\TVShow($this->tmdb, $t);
            yield $tvshow;
        }
    }
}
