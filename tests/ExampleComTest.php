<?php

class HelloWorldTest extends Friday\TestCase
{
    public function setUp()
    {
        $this->session->open('http://www.example.com/');
    }

    public function testTitle() {
        $this->assertEquals('Example Domain', $this->session->title());
    }

    /**
     * @runInSeparateProcess
     */
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
