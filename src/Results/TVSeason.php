<?php
/**
 * This file is part of the Tmdb package.
 *
 * (c) Vincent Faliès <vincent.falies@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *

 * @author Vincent Faliès <vincent.falies@gmail.com>
 * @copyright Copyright (c) 2017
 */


namespace vfalies\tmdb\Results;

use vfalies\tmdb\Abstracts\Results;
use vfalies\tmdb\Interfaces\Results\TVSeasonResultsInterface;
use vfalies\tmdb\Traits\ElementTrait;
use vfalies\tmdb\Interfaces\TmdbInterface;

/**
 * Class to manipulate a TV Season result
 * @package Tmdb
 * @author Vincent Faliès <vincent.falies@gmail.com>
 * @copyright Copyright (c) 2017
 */
class TVSeason extends Results implements TVSeasonResultsInterface
{

    use ElementTrait;

    /**
     * Episode count
     * @var int
     */
    protected $episode_count = 0;
    /**
     * Season number
     * @var int
     */
    protected $season_number = 0;
    /**
     * Image poster path
     * @var string
     */
    protected $poster_path   = null;
    /**
     * Air date
     * @var string
     */
    protected $air_date      = null;
    /**
     * Id
     * @var int
     */
    protected $id            = null;

    /**
     * Constructor
     * @param \vfalies\tmdb\Interfaces\TmdbInterface $tmdb
     * @param \stdClass $result
     * @throws \Exception
     */
    public function __construct(TmdbInterface $tmdb, \stdClass $result)
    {
        parent::__construct($tmdb, $result);

        // Populate data
        $this->id            = $this->data->id;
        $this->air_date      = $this->data->air_date;
        $this->episode_count = $this->data->episode_count;
        $this->poster_path   = $this->data->poster_path;
        $this->season_number = $this->data->season_number;
    }

    /**
     * Id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Air date
     * @return string
     */
    public function getAirDate()
    {
        return $this->air_date;
    }

    /**
     * Episode count
     * @return int
     */
    public function getEpisodeCount()
    {
        return (int) $this->episode_count;
    }

    /**
     * Season Number
     * @return int
     */
    public function getSeasonNumber()
    {
        return (int) $this->season_number;
    }

}
