<?php

class HelloWorldTest extends PHPUnit_Framework_TestCase
{
    protected static $webDriverHost = 'http://localhost:4444/wd/hub';
    protected static $webDriver;
    protected static $webDriverSession;
    protected $session;

    public static function setUpBeforeClass() {
        static::$webDriver = new WebDriver\WebDriver(static::$webDriverHost);
        static::$webDriverSession = static::$webDriver->session('firefox');
    }

    public static function tearDownAfterClass() {
        static::$webDriverSession->close();
    }

    public function setUp()
    {
        $this->session = static::$webDriverSession;
        $this->session->open('http://www.example.com/');
    }

    public function testTitle() {
        $this->assertEquals('Example Domain', $this->session->title());
    }

    public function testContent() {
        $this->assertContains('Example Domain', $this->session->element('xpath', '//h1')->text());
        $this->assertContains('This domain', $this->session->element('css selector', 'p')->text());
    }

    public function testLink() {
        $this->assertEmpty($this->session->elements('partial link text', 'Something non-existent'));
        $this->session->element('partial link text', 'More')->click();
        $this->assertEquals('http://www.iana.org/domains/reserved', $this->session->url());
    }

}
