<?php

namespace Friday;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    protected static $webDriverHost = 'http://localhost:4444/wd/hub';
    protected static $webDriver;
    protected static $webDriverSession;

    public static function setUpBeforeClass() {
        fwrite(STDOUT, __METHOD__ . "\n");
        static::$webDriver = new \WebDriver\WebDriver(static::$webDriverHost);
        static::$webDriverSession = static::$webDriver->session('firefox');
    }

    public static function tearDownAfterClass() {
        fwrite(STDOUT, __METHOD__ . "\n");
        static::$webDriverSession->close();
    }
    
    public static function suite($className)
    {
        fwrite(STDOUT, __METHOD__ . "\n");
        return \Friday\TestSuite::fromTestCaseClass($className);
    }
}
