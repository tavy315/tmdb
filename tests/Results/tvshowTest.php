<?php

namespace vfalies\tmdb\Results;

use PHPUnit\Framework\TestCase;

/**
 * @cover TVShow
 */
class TVShowTest extends TestCase
{

    protected $tmdb   = null;
    protected $result = null;

    public function setUp()
    {
        parent::setUp();

        $this->tmdb = $this->getMockBuilder(\vfalies\tmdb\Tmdb::class)
                ->setConstructorArgs(array('fake_api_key', 3, new \Monolog\Logger('Tmdb', [new \Monolog\Handler\StreamHandler('logs/unittest.log')])))
                ->setMethods(['sendRequest', 'getConfiguration'])
                ->getMock();
    }

    public function tearDown()
    {
        parent::tearDown();

        $this->tmdb = null;
    }

    private function sendRequestOk()
    {
        $json_object = json_decode(file_get_contents('tests/json/configurationOk.json'));
        $this->tmdb->method('getConfiguration')->willReturn($json_object);

        $json_object = json_decode(file_get_contents('tests/json/searchTVShowOk.json'));
        $this->tmdb->method('sendRequest')->willReturn($json_object);

        $search       = new \vfalies\tmdb\Search($this->tmdb);
        $this->result = $search->tvshow('star trek', array('language' => 'fr-FR'))->current();
    }

    private function sendRequestConfNok()
    {
        $json_object = json_decode(file_get_contents('tests/json/configurationEmptyOk.json'));
        $this->tmdb->method('getConfiguration')->willReturn($json_object);

        $json_object = json_decode(file_get_contents('tests/json/searchTVShowOk.json'));
        $this->tmdb->method('sendRequest')->willReturn($json_object);

        $search       = new \vfalies\tmdb\Search($this->tmdb);
        $this->result = $search->tvshow('star trek', array('language' => 'fr-FR'))->current();
    }

    /**
     * @test
     */
    public function testGetId()
    {
        $this->sendRequestOk();

        $this->assertInternalType('int', $this->result->getId());
        $this->assertEquals(253, $this->result->getId());
    }

    /**
     * @test
     */
    public function testGetOverview()
    {
        $this->sendRequestOk();

        $this->assertInternalType('string', $this->result->getOverview());
        $this->assertStringStartsWith('Star Trek, ou Patrouille du cosmos au Québec et au Nouveau-Brunswick', $this->result->getOverview());
    }

    /**
     * @test
     */
    public function testGetReleaseDate()
    {
        $this->sendRequestOk();

        $this->assertInternalType('string', $this->result->getReleaseDate());
        $this->assertEquals('1966-09-08', $this->result->getReleaseDate());
    }

    /**
     * @test
     */
    public function testGetOriginalTitle()
    {
        $this->sendRequestOk();

        $this->assertInternalType('string', $this->result->getOriginalTitle());
        $this->assertEquals('Star Trek', $this->result->getOriginalTitle());
    }

    /**
     * @test
     */
    public function testGetTitle()
    {
        $this->sendRequestOk();

        $this->assertInternalType('string', $this->result->getTitle());
        $this->assertEquals('Star Trek', $this->result->getTitle());
    }
}
