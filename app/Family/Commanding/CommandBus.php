<?php

namespace Family\Commanding;


use Illuminate\Foundation\Application;

class CommandBus {

    protected $commandTranslator;
    /**
     * @var Application
     */
    private $application;

    function __construct(Application $application, CommandTranslator $commandTranslator)
    {
        $this->application = $application;
        $this->commandTranslator = $commandTranslator;
    }
    public function execute($command)
    {
        $handler = $this->commandTranslator->toCommandHandler($command);

        return $this->application->make($handler)->handle($command);
    }
} 