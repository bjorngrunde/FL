<?php

namespace Family\Applys;


use Application;
use Family\Commanding\CommandHandler;
use Family\Eventing\EventDispatcher;

class PostApplicationCommandHandler implements CommandHandler {
    protected $application;
    private $dispatcher;

    function __construct(Application $application, EventDispatcher $dispatcher)
    {
        $this->application = $application;
        $this->dispatcher = $dispatcher;
    }
    public function handle($command)
    {
        $application = $this->application->post(
            $command->name,
            $command->lastName,
            $command->username,
            $command->email,
            $command->server,
            $command->talents,
            $command->klass,
            $command->armory,
            $command->played,
            $command->playClass,
            $command->bio,
            $command->raidExperience,
            $command->reasonToApplyFl,
            $command->oldGuild,
            $command->progressRaid,
            $command->attendance,
            $command->screenshot
        );
        $this->dispatcher->dispatch($application->releaseEvents());
    }
}