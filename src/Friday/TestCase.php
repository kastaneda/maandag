<?php

namespace Friday;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \WebDriver\WebDriver
     */
    protected $webDriver;

    /**
     * @var \WebDriver\Session
     */
    protected $session;

    protected $browserName;

    protected $newSession = FALSE;

    public function setSelenium($webDriver, $session, $browserName)
    {
        $this->webDriver = $webDriver;
        $this->session = $session;
        $this->browserName = $browserName;
    }

    protected function newSession()
    {
        $this->session = $this->webDriver->session($this->browserName);
        $this->newSession = TRUE;
    }

    public function __destruct()
    {
        if ($this->newSession) {
            $this->session->close();
        }
    }

    public static function suite($className)
    {
        return \Friday\TestSuite::fromTestCaseClass($className);
    }

    public function run(\PHPUnit_Framework_TestResult $result = NULL)
    {
        if ($this->runTestInSeparateProcess === TRUE) {
            $this->newSession();
            $this->runTestInSeparateProcess = FALSE;
        }
        return parent::run($result);
    }
}
