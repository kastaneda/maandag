<?php

class HelloWorldTest extends PHPUnit_Framework_TestCase
{
    protected static $webDriverHost = 'http://localhost:4444/wd/hub';
    protected static $webDriver;
    protected static $session;

    public static function setUpBeforeClass() {
        static::$webDriver = new PHPWebDriver_WebDriver(static::$webDriverHost);
        static::$session = static::$webDriver->session('firefox');
    }

    public static function tearDownAfterClass() {
        static::$session->close();
    }

    public function setUp()
    {
        static::$session->open('http://www.example.com/');
    }

    public function testTitle() {
        $this->assertEquals('Example Domain', static::$session->title());
    }

    public function testContent() {
        $this->assertContains('Example Domain', static::$session->element('xpath', '//h1')->text());
        $this->assertContains('This domain', static::$session->element('css selector', 'p')->text());
    }

    public function testLink() {
        $this->assertEmpty(static::$session->elements('partial link text', 'Something non-existent'));
        static::$session->element('partial link text', 'More')->click();
        $this->assertEquals('http://www.iana.org/domains/reserved', static::$session->url());
    }

}
