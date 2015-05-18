<?php

class HelloWorldTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function setUp()
    {
        $this->setBrowser(BROWSER);
        $this->setBrowserUrl(BROWSER_URL);
    }

    public function setUpPage()
    {
        $this->url(BROWSER_URL);
    }

    public function testTitle()
    {
        $this->assertEquals('Example Domain', $this->title());
    }

    public function testContent()
    {
        $this->assertContains('Example Domain', $this->byXPath('//h1')->text());
        $this->assertContains('This domain', $this->byCssSelector('p')->text());
    }

    /** @expectedException PHPUnit_Extensions_Selenium2TestCase_WebDriverException */
    public function testBadLink()
    {
        $this->byPartialLinkText('Something non-existent');
    }

    public function testLink()
    {
        $this->byPartialLinkText('More')->click();
        $this->assertEquals('http://www.iana.org/domains/reserved', $this->url());
    }
}
