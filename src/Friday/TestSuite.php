<?php

namespace Friday;

class TestSuite extends \PHPUnit_Framework_TestSuite
{
    /**
     * @var boolean
     */
    protected $testCase = TRUE;

    /**
     * @var \Friday\TestEnvironment[]
     */
    protected $sharedEnvironments = array();

    protected function setUp()
    {
        $count = 0;
        do {
            $finish = TRUE;
            $count++;
            $constServerUrl = 'SELENIUM_SERVER_URL_' . $count;
            $constBrowserName = 'SELENIUM_BROWSER_' . $count;
            if (defined($constServerUrl) && defined($constBrowserName)) {
                $finish = FALSE;
                $environment = new TestEnvironment(constant($constServerUrl), constant($constBrowserName));
                // TODO: place to add optional parameters
                $this->sharedEnvironments[] = $environment;
            }
        } while(!$finish);
    }

    /**
     * @param   \PHPUnit_Framework_Test         $test
     * @param   \PHPUnit_Framework_TestResult   $result
     */
    public function runTest(\PHPUnit_Framework_Test $test, \PHPUnit_Framework_TestResult $result)
    {
        if ($test instanceof \Friday\TestCase) {
            foreach ($this->sharedEnvironments as $environment) {
                $test->setEnvironment($this->sharedEnvironments[0]);
                $test->run($result);
            }
        } else {
            $test->run($result);
        }
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
