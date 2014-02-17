<?php

namespace Friday;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Friday\TestEnvironment
     */
    protected $environment;

    /**
     * @var \WebDriver\Session
     */
    protected $session;


    /**
     * @var boolean
     */
    protected $newSession = FALSE;

    /**
     * @param   \Friday\TestEnvironment         $environment
     */
    public function setEnvironment(TestEnvironment $environment)
    {
        $this->environment = $environment;
        $this->session = $this->environment->getSession();
    }

    protected function newSession()
    {
        $this->environment = clone $this->environment;
        $this->session = $this->environment->getSession();
    }

    /**
     * @param   string                          $className
     */
    public static function suite($className)
    {
        return TestSuite::fromTestCaseClass($className);
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
