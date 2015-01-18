<?php

namespace Family\Applys;

use Family\Forms\ApplicationForm;
class PostApplicationValidator
{
    private $form;

    function __construct(ApplicationForm $applicationForm)
    {
        $this->form = $applicationForm;
    }

    public function validate(PostApplicationCommand $command)
    {
        $input = [
            'name'          =>  $command->name,
            'lastName'      =>  $command->lastName,
            'username'      =>  $command->username,
            'email'         =>  $command->email,
            'server'        =>  $command->server,
            'talents'       =>  $command->talents,
            'klass'         =>  $command->klass,
            'armory'        =>  $command->armory,
            'played'        =>  $command->played,
            'playClass'     =>  $command->playClass,
            'bio'           =>  $command->bio,
            'raidExperience'=>  $command->raidExperience,
            'reasonToApplyFl'=> $command->reasonToApplyFl,
            'oldGuild'      =>  $command->oldGuild,
            'progressRaid'  =>  $command->progressRaid,
            'attendance'    =>  $command->attendance,
            'screenshot'    =>  $command->screenshot
        ];

        $this->form->validate($input);
    }
} 