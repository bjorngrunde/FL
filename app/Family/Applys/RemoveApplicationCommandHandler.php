<?php

namespace Family\Applys;

use Application;
use Family\Commanding\CommandHandler;
use Family\Eventing\EventDispatcher;
class RemoveApplicationCommandHandler implements CommandHandler
{
    private $application;
    private $dispatcher;

    function __construct(Application $application, EventDispatcher $dispatcher)
    {
        $this->application = $application;
        $this->dispatcher = $dispatcher;
    }

    public function handle($command)
    {
        $application = $this->application->with('status')->findOrFail($command->id);
        $application->remove();

        $this->dispatcher->dispatch($application->releaseEvents());
    }
}