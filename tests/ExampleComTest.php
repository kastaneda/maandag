<?php

class HelloWorldTest extends PHPUnit_Framework_TestCase
{
    protected $webDriverHost = 'http://localhost:4444/wd/hub';
    protected $webDriver;
    protected $session;

    public function setUp() {
        $this->webDriver = new PHPWebDriver_WebDriver($this->webDriverHost);
        $this->session = $this->webDriver->session('firefox');
    }

    public function tearDown() {
        $this->session->close();
    }

    public function testTitle() {
        $this->session->open('http://www.example.com/');
        $this->assertEquals('Example Domain', $this->session->title());
    }

    public function testContent() {
        $this->session->open('http://www.example.com/');
        $this->assertContains('Example Domain', $this->session->element('xpath', '//h1')->text());
        $this->assertContains('This domain', $this->session->element('css selector', 'p')->text());
    }

    public function testLink() {
        $this->session->open('http://www.example.com/');
        $this->session->element('partial link text', 'More')->click();
        $this->assertEquals('http://www.iana.org/domains/reserved', $this->session->url());
    }

}
