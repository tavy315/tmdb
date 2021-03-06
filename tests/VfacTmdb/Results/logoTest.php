<?php

namespace VfacTmdb\Results;

use PHPUnit\Framework\TestCase;
use VfacTmdb\lib\Guzzle\Client as HttpClient;

/**
 * @cover Logo
 */
class LogoTest extends TestCase
{
    protected $tmdb          = null;
    protected $result        = null;
    protected $network_id    = 4;

    public function setUp()
    {
        parent::setUp();

        $this->tmdb = $this->getMockBuilder(\VfacTmdb\Tmdb::class)
                ->setConstructorArgs(array('fake_api_key', 3, new \Monolog\Logger('Tmdb', [new \Monolog\Handler\StreamHandler('logs/unittest.log')]), new HttpClient(new \GuzzleHttp\Client())))
                ->setMethods(['sendRequest', 'getConfiguration'])
                ->getMock();
    }

    public function tearDown()
    {
        parent::tearDown();

        $this->tmdb = null;
    }

    private function getRequestOk()
    {
        $json_object = json_decode(file_get_contents('tests/json/configurationOk.json'));
        $this->tmdb->method('getConfiguration')->willReturn($json_object);

        $network = new \VfacTmdb\Items\TVNetwork($this->tmdb, $this->network_id);

        $json_object = json_decode(file_get_contents('tests/json/LogosOk.json'));
        $this->tmdb->method('sendRequest')->willReturn($json_object);

        $this->result = $network->getLogos()->current();
    }

    /**
     * @test
     */
    public function testGetId()
    {
        $this->getRequestOk();

        $this->assertInternalType('int', $this->result->getId());
        $this->assertEquals(4, $this->result->getId());
    }

    /**
     * @test
     * @expectedException \VfacTmdb\Exceptions\NotFoundException
     */
    public function testContructFailed()
    {
        $result               = new \stdClass();
        $result->id           = 4;
        $result->not_property = 'test';

        new \VfacTmdb\Results\Logo($this->tmdb, 4, $result);
    }

    /**
     * @test
     */
    public function testGetAspectRatio()
    {
        $this->getRequestOk();

        $this->assertInternalType('double', $this->result->getAspectRatio());
        $this->assertEquals(1.373239436619718, $this->result->getAspectRatio());
    }

    /**
     * @test
     */
    public function testGetFilePath()
    {
        $this->getRequestOk();

        $this->assertEquals('/8UNCAmEJGuwKhgEPfqwymVF3xRn.svg', $this->result->getFilePath());
    }

    /**
     * @test
     */
    public function testGetFilePathPng()
    {
        $this->getRequestOk();

        $this->assertEquals('/8UNCAmEJGuwKhgEPfqwymVF3xRn.png', $this->result->getFilePath(false));
    }

    /**
     * @test
     */
    public function testGetFilePathSvg()
    {
        $this->getRequestOk();

        $this->assertEquals('/8UNCAmEJGuwKhgEPfqwymVF3xRn.svg', $this->result->getFilePath(true));
    }

    /**
     * @test
     */
    public function testGetFileType()
    {
        $this->getRequestOk();

        $this->assertInternalType('string', $this->result->getFileType());
        $this->assertEquals('.svg', $this->result->getFileType());
    }

    /**
     * @test
     */
    public function testGetHeight()
    {
        $this->getRequestOk();

        $this->assertInternalType('int', $this->result->getHeight());
        $this->assertEquals(142, $this->result->getHeight());
    }

    /**
     * @test
     */
    public function testGetLogoId()
    {
        $this->getRequestOk();

        $this->assertInternalType('string', $this->result->getLogoId());
        $this->assertEquals('5a7b16c1c3a3687b63008706', $this->result->getLogoId());
    }

    /**
     * @test
     */
    public function testGetVoteAverage()
    {
        $this->getRequestOk();

        $this->assertInternalType('double', $this->result->getVoteAverage());
        $this->assertEquals(5.246, $this->result->getVoteAverage());
    }

    /**
     * @test
     */
    public function testGetVoteCount()
    {
        $this->getRequestOk();

        $this->assertInternalType('int', $this->result->getVoteCount());
        $this->assertEquals(2, $this->result->getVoteCount());
    }

    /**
     * @test
     */
    public function testGetWidth()
    {
        $this->getRequestOk();

        $this->assertInternalType('int', $this->result->getWidth());
        $this->assertEquals(195, $this->result->getWidth());
    }
}
