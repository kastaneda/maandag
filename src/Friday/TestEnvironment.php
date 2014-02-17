<?php

namespace Friday;

class TestEnvironment
{
    /**
     * @var \WebDriver\WebDriver
     */
    protected $webDriver;

    /**
     * @var \WebDriver\Session
     */
    protected $webDriverSession;

    /**
     * @var string
     */
    protected $browserName;

    public function __construct($seleniumServerUrl, $browserName)
    {
        $this->webDriver = new \WebDriver\WebDriver($seleniumServerUrl);
        $this->webDriverSession = $this->webDriver->session($browserName);
        $this->browserName = $browserName;
    }

    public function __destruct()
    {
        $this->webDriverSession->close();
    }

    public function __clone()
    {
        $this->webDriverSession = $this->webDriver->session($this->browserName);
    }

    public function getSession()
    {
        return $this->webDriverSession;
    }
}
