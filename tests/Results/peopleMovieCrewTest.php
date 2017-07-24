<?php

namespace vfalies\tmdb\Results;

use PHPUnit\Framework\TestCase;

/**
 * @cover PeopleMovieCrew
 */
class PeopleMovieCrewTest extends TestCase
{

    protected $tmdb      = null;
    protected $result    = null;
    protected $people_id = 66633;
    protected $moviecrew = null;

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

        $People = new \vfalies\tmdb\Items\People($this->tmdb, $this->people_id);

        $json_object = json_decode(file_get_contents('tests/json/PeopleMovieCreditOk.json'));
        $this->tmdb->method('sendRequest')->willReturn($json_object);

        $this->moviecrew = $People->getMoviesCrew()->current();
    }

    /**
     * @test
     */
    public function testGetId()
    {
        $this->sendRequestOk();

        $this->assertInternalType('int', $this->moviecrew->getId());
        $this->assertEquals(8960, $this->moviecrew->getId());
    }

    /**
     * @test
     */
    public function getCreditId()
    {
        $this->sendRequestOk();

        $this->assertEquals('52fe44cbc3a36847f80aa581', $this->moviecrew->getCreditId());
    }

    /**
     * @test
     */
    public function testGetTitle()
    {
        $this->sendRequestOk();

        $this->assertEquals('Hancock', $this->moviecrew->getTitle());
    }

    /**
     * @test
     */
    public function testGetOriginalTitle()
    {
        $this->sendRequestOk();

        $this->assertEquals('Hancock', $this->moviecrew->getOriginalTitle());
    }

    /**
     * @test
     */
    public function testGetDepartment()
    {
        $this->sendRequestOk();

        $this->assertEquals('Writing', $this->moviecrew->getDepartment());
    }

    /**
     * @test
     */
    public function testGetReleaseDate()
    {
        $this->sendRequestOk();

        $this->assertEquals('2008-07-01', $this->moviecrew->getReleaseDate());
    }

    /**
     * @test
     */
    public function testGetAdult()
    {
        $this->sendRequestOk();

        $this->assertEquals(false, $this->moviecrew->getAdult());
    }

    /**
     * @test
     */
    public function testGetJob()
    {
        $this->sendRequestOk();

        $this->assertEquals('Screenplay', $this->moviecrew->getJob());
    }

    /**
     * @test
     */
    public function testGetPosterPath()
    {
        $this->sendRequestOk();

        $this->assertEquals('/dsCxSr4w3g2ylhlZg3v5CB5Pid7.jpg', $this->moviecrew->getPosterPath());
    }

}