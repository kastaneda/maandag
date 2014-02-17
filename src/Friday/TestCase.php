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

    /**
     * @var string
     */
    protected $browserName;

    /**
     * @var boolean
     */
    protected $newSession = FALSE;

    /**
     * @param   \WebDriver\WebDriver            $webDriver
     * @param   \WebDriver\Session              $session
     * @param   string                          $browserName
     */
    public function setSelenium(\WebDriver\WebDriver $webDriver, \WebDriver\Session $session, $browserName)
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

    /**
     * @param   string                          $className
     */
    public static function suite($className)
    {
        return \Friday\TestSuite::fromTestCaseClass($className);
    }

    /**
     * @param   \PHPUnit_Framework_TestResult   $result
     */
    public function run(\PHPUnit_Framework_TestResult $result = NULL)
    {
        if ($this->runTestInSeparateProcess === TRUE) {
            $this->newSession();
            $this->runTestInSeparateProcess = FALSE;
        }
        return parent::run($result);
    }
}
