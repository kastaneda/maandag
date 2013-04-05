<?php

class HelloWorldTest extends PHPUnit_Framework_TestCase
{

    const WEBDRIVER_HOST = 'http://localhost:4444/wd/hub';
    protected $webDriver;
    protected $session;

    public function setUp() {
        $this->webDriver = new WebDriver\WebDriver(self::WEBDRIVER_HOST);
        $this->session = $this->webDriver->session('firefox');
    }

    public function tearDown() {
        $this->session->close();
    }

    public function testExampleCom() {
        $this->session->open('http://www.example.com/');
        $this->assertEquals('Example Domain', $this->session->title());
    }

}
