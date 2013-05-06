<?php

class HelloWorldTest extends PHPUnit_Extensions_Selenium2TestCase
{

    public function setUp() {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://www.example.com/');
    }

    public function testExampleCom() {
        $this->url('http://www.example.com/');
        $this->assertEquals('Example Domain', $this->title());
        $this->assertContains('Example Domain', $this->byXPath('//h1')->text());
        $this->assertContains('This domain', $this->byCssSelector('p')->text());
        $this->byLinkText('More information...')->click();
        $this->assertEquals('http://www.iana.org/domains/special', $this->url());
    }

}
