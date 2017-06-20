<?php

namespace vfalies\tmdb\Abstracts;

use vfalies\tmdb\Tmdb;
use vfalies\tmdb\lib\Guzzle\Client as HttpClient;
use vfalies\tmdb\TmdbException;

abstract class Item extends Element
{

    protected $id     = null;
    protected $tmdb   = null;
    protected $logger = null;

    /**
     * Constructor
     * @param \vfalies\tmdb\Tmdb $tmdb
     * @param int $item_id
     * @param array $options
     * @param string $item_name
     * @throws \Exception
     */
    public function __construct(Tmdb $tmdb, int $item_id, array $options, string $item_name)
    {
        try {
            $this->id     = (int) $item_id;
            $this->tmdb   = $tmdb;
            $this->logger = $tmdb->logger;
            $this->conf   = $this->tmdb->getConfiguration();
            $params       = $this->tmdb->checkOptions($options);
            $this->data   = $this->tmdb->sendRequest(new HttpClient(new \GuzzleHttp\Client()), $item_name . '/' . (int) $item_id, null, $params);
        } catch (TmdbException $ex) {
            throw $ex;
        }
    }
}