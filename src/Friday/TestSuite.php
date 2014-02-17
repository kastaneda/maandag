<?php

namespace Friday;

class TestSuite extends \PHPUnit_Framework_TestSuite
{
    /**
     * @var boolean
     */
    protected $testCase = TRUE;

    /**
     * @var \WebDriver\WebDriver
     */
    protected $webDriver;

    /**
     * @var \WebDriver\Session
     */
    protected $webDriverSession;

    protected function setUp()
    {
        // FIXME
        $this->webDriver = new \WebDriver\WebDriver('http://localhost:4444/wd/hub');
        $this->webDriverSession = $this->webDriver->session('firefox');
    }

    protected function tearDown()
    {
        $this->webDriverSession->close();
    }

    /**
     * Runs a test.
     *
     * @param  \PHPUnit_Framework_Test          $test
     * @param  \PHPUnit_Framework_TestResult    $result
     */
    public function runTest(\PHPUnit_Framework_Test $test, \PHPUnit_Framework_TestResult $result)
    {
        if ($test instanceof \Friday\TestCase) {
            $test->setSession($this->webDriverSession);
        }

        $test->run($result);
    }

    /**
     * @param string $className extending \PHPUnit_Extensions_SeleniumTestCase
     * @return \PHPUnit_Extensions_SeleniumTestSuite
     */
    public static function fromTestCaseClass($className)
    {
        $suite = new self();
        $suite->setName($className);

        $class = new \ReflectionClass($className);
        $classGroups = \PHPUnit_Util_Test::getGroups($className);

        foreach ($class->getMethods() as $method) {
            $suite->addTestMethod($class, $method);
        }

        return $suite;
    }
}
