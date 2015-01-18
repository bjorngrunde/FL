<?php

namespace Family\Applys;
use Application;

class ApplicationWasUpdated
{
    public $application;

    function __construct(Application $application)
    {
        $this->application = $application;
    }
} 