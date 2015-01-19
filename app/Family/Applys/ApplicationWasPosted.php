<?php

namespace Family\Applys;
use Application;

class ApplicationWasPosted
{
    public $application;

    function __construct(Application $application)
    {
        $this->application = $application;
    }

} 