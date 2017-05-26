<?php

namespace Vfac\Tmdb;

class Movie implements Interfaces\Movie
{

    private $_tmdb   = null;
    private $_conf   = null;
    private $_genres = null;
    private $_data   = null;
    private $id      = null;

    /**
     * Constructor
     * @param \Vfac\Tmdb\Tmdb $tmdb
     * @param int $movie_id
     * @param array $options
     * @throws Exception
     */
    public function __construct(Tmdb $tmdb, int $movie_id, array $options = array())
    {
        try
        {
            $this->id      = (int) $movie_id;
            $this->_tmdb   = $tmdb;
            $this->_conf   = $this->_tmdb->getConfiguration();

            // Get movie details
            $params      = $this->_tmdb->checkOptions($options);
            $this->_data = $this->_tmdb->sendRequest('movie/' . $movie_id, null, $params);
        }
        catch (\Exception $ex)
        {
            throw new \Exception($ex->getMessage(), $ex->getCode(), $ex);
        }
    }

    /**
     * Get all movie genres list
     * @return array
     */
    public function getAllGenres() : array
    {
        try
        {
            if (is_null($this->_genres))
            {
                $genres = $this->_tmdb->sendRequest('genre/movie/list');

                $this->_genres = [];
                foreach ($genres->genres as $genre)
                {
                    $this->genres[$genre->id] = $genre->name;
                }
            }

            return $this->genres;
        }
        catch (\Exception $ex)
        {
            throw new \Exception($ex->getMessage(), $ex->getCode(), $ex);
        }
    }

    /**
     * Get movie genres
     * @return array
     */
    public function getGenres() : array
    {
        if (isset($this->_data->genres))
        {
            return $this->_data->genres;
        }
        return null;
    }

    /**
     * Get movie title
     * @return string
     */
    public function getTitle() : string
    {
        if (isset($this->_data->title))
        {
            return $this->_data->title;
        }
        return null;
    }

    /**
     * Get movie overview
     * @return string
     */
    public function getOverview() : string
    {
        if (isset($this->_data->overview))
        {
            return $this->_data->overview;
        }
        return null;
    }

    /**
     * Get movie release date
     * @return string
     */
    public function getReleaseDate() : string
    {
        if (isset($this->_data->release_date))
        {
            return $this->_data->release_date;
        }
        return null;
    }

    /**
     * Get movie original title
     * @return string
     */
    public function getOriginalTitle() : string
    {
        if (isset($this->_data->original_title))
        {
            return $this->_data->original_title;
        }
        return null;
    }

    /**
     * Get movie note
     * @return float
     */
    public function getNote() : float
    {
        if (isset($this->_data->vote_average))
        {
            return $this->_data->vote_average;
        }
        return null;
    }

    /**
     * Get movie id
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get IMDB movie id
     * @return int
     */
    public function getIMDBId() : int
    {
        if (isset($this->_data->imdb_id))
        {
            return $this->_data->imdb_id;
        }
        return null;
    }

    /**
     * Get movie tagline
     * @return string
     */
    public function getTagLine() : string
    {
        if (isset($this->_data->tagline))
        {
            return $this->_data->tagline;
        }
        return null;
    }

    /**
     * Get collection id
     * @return int
     */
    public function getCollectionId() : int
    {
        if ( ! empty($this->_data->belongs_to_collection))
        {
            return (int) $this->_data->belongs_to_collection->id;
        }
        return null;
    }

    /**
     * Get movie poster
     * @param string $size
     * @return string
     */
    public function getPoster(string $size = 'w185') : string
    {
        if (isset($this->_data->poster_path))
        {
            if ( ! isset($this->_conf->images->base_url))
            {
                throw new \Exception('base_url configuration not found');
            }
            if ( ! in_array($size, $this->_conf->images->poster_sizes))
            {
                throw new \Exception('Incorrect poster size : '.$size);
            }
            return $this->_conf->images->base_url.$size.$this->_data->poster_path;
        }
        return null;
    }

    /**
     * Get movie backdrop
     * @param string $size
     * @return string|null
     */
    public function getBackdrop(string $size = 'w780') : string
    {
        if (isset($this->_data->backdrop_path))
        {
            if ( ! isset($this->_conf->images->base_url))
            {
                throw new \Exception('base_url configuration not found');
            }
            if ( ! in_array($size, $this->_conf->images->backdrop_sizes))
            {
                throw new \Exception('Incorrect backdrop size : '.$size);
            }
            return $this->_conf->images->base_url.$size.$this->_data->backdrop_path;
        }
        return null;
    }
}
