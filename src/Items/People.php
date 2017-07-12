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


namespace vfalies\tmdb\Items;

use vfalies\tmdb\Abstracts\Item;
use vfalies\tmdb\Interfaces\PeopleInterface;
use vfalies\tmdb\Tmdb;
use vfalies\tmdb\Traits\ElementTrait;
use vfalies\tmdb\lib\Guzzle\Client as HttpClient;
use vfalies\tmdb\Results\Image;

/**
 * People class
 * @author Vincent Faliès <vincent.falies@gmail.com>
 * @copyright Copyright (c) 2017
 */
class People extends Item implements PeopleInterface
{

    use ElementTrait;

    /**
     * Constructor
     * @param \vfalies\tmdb\Tmdb $tmdb
     * @param int $people_id
     * @param array $options
     * @throws Exception
     */
    public function __construct(Tmdb $tmdb, $people_id, array $options = array())
    {
        parent::__construct($tmdb, $people_id, $options, 'people');
    }

    /**
     * Adult
     * @return boolean
     */
    public function getAdult()
    {
        if (isset($this->data->adult))
        {
            return $this->data->adult;
        }
        return false;
    }

    /**
     * Alse Known as
     * @return array
     */
    public function getAlsoKnownAs()
    {
        if (isset($this->data->also_known_as))
        {
            return $this->data->also_known_as;
        }
        return [];
    }

    /**
     * Biography
     * @return string
     */
    public function getBiography()
    {
        if (isset($this->data->biography))
        {
            return $this->data->biography;
        }
        return '';
    }

    /**
     * Birthday
     * @return string
     */
    public function getBirthday()
    {
        if (isset($this->data->birthday))
        {
            return $this->data->birthday;
        }
        return '';
    }

    /**
     * Deathday
     * @return string
     */
    public function getDeathday()
    {
        if (isset($this->data->deathday))
        {
            return $this->data->deathday;
        }
        return '';
    }

    /**
     * Gender
     * @return int
     */
    public function getGender()
    {
        if (isset($this->data->gender))
        {
            return $this->data->gender;
        }
        return 0;
    }

    /**
     * Homepage
     * @return string
     */
    public function getHomepage()
    {
        if (isset($this->data->homepage))
        {
            return $this->data->homepage;
        }
        return '';
    }

    /**
     * Id
     * @return int
     */
    public function getId()
    {
        if (isset($this->data->id))
        {
            return $this->data->id;
        }
        return 0;
    }

    /**
     * Imdb Id
     * @return string
     */
    public function getImdbId()
    {
        if (isset($this->data->imdb_id))
        {
            return $this->data->imdb_id;
        }
        return '';
    }

    /**
     * Name
     * @return string
     */
    public function getName()
    {
        if (isset($this->data->name))
        {
            return $this->data->name;
        }
        return '';
    }

    /**
     * Place of birth
     * @return string
     */
    public function getPlaceOfBirth()
    {
        if (isset($this->data->place_of_birth))
        {
            return $this->data->place_of_birth;
        }
        return '';
    }

    /**
     * Popularity
     * @return int
     */
    public function getPopularity()
    {
        if (isset($this->data->popularity))
        {
            return $this->data->popularity;
        }
        return 0;
    }

    /**
     * Image profile path
     * @return string
     */
    public function getProfilePath()
    {
        if (isset($this->data->profile_path))
        {
            return $this->data->profile_path;
        }
        return '';
    }

    /**
     * Images Profiles
     * @return \Generator|Results\Image
     */
    public function getProfiles()
    {
        $data = $this->tmdb->sendRequest(new HttpClient(new \GuzzleHttp\Client()), '/person/'.(int) $this->id.'/images', null, $this->params);

        foreach ($data->profiles as $b)
        {
            $image = new Image($this->tmdb, $this->id, $b);
            yield $image;
        }
    }
}
