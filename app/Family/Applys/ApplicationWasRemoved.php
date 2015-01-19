<?php

namespace Family\Applys;

use Application;
class ApplicationWasRemoved {

    public $application;

    function __construct(Application $application)
    {
        $this->application = $application;
    }
} 