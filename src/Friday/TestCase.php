<?php

namespace Friday;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    protected $session;

    public function setSession($session)
    {
        $this->session = $session;
    }

    public static function suite($className)
    {
        return \Friday\TestSuite::fromTestCaseClass($className);
    }
}
