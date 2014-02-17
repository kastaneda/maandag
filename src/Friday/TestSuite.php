<?php


namespace Friday;

class TestSuite extends \PHPUnit_Framework_TestSuite
{
    /**
     * @var boolean
     */
    protected $testCase = TRUE;

    protected function setUp()
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }

    protected function tearDown()
    {
        fwrite(STDOUT, __METHOD__ . "\n");
    }

    /**
     * Runs a test.
     *
     * @param  \PHPUnit_Framework_Test          $test
     * @param  \PHPUnit_Framework_TestResult    $result
     */
    public function runTest(\PHPUnit_Framework_Test $test, \PHPUnit_Framework_TestResult $result)
    {
        fwrite(STDOUT, __METHOD__ . "\n");
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
