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


namespace VfacTmdb\Interfaces\Results;

/**
 * Interface for TVSeason results type object
 * @package Tmdb
 * @author Vincent Faliès <vincent@vfac.fr>
 * @copyright Copyright (c) 2017
 */
interface TVSeasonResultsInterface extends ResultsInterface
{
    /**
     * Episode count
     * @return int
     */
    public function getEpisodeCount() : int;

    /**
     * Image poster path
     * @return string
     */
    public function getPosterPath() : string;

    /**
     * Season number
     * @return int
     */
    public function getSeasonNumber() : int;

    /**
     * Get movie release date
     * @return string
     */
    public function getAirDate() : string;
}
