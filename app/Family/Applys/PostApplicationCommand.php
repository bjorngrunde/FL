<?php

namespace Family\Applys;


class PostApplicationCommand {

    public $name;
    public $lastName;
    public $username;
    public $email;
    public $server;
    public $talents;
    public $klass;
    public $armory;
    public $played;
    public $playClass;
    public $bio;
    public $raidExperience;
    public $reasonToApplyFl;
    public $oldGuild;
    public $progressRaid;
    public $attendance;
    public $screenshot;

    public function __construct($name, $lastName, $username, $email, $server, $talents, $klass, $armory, $played, $playClass, $bio, $raidExperience, $reasonToApplyFl, $oldGuild, $progressRaid, $attendance, $screenshot)
    {

        $this->name = $name;
        $this->lastName = $lastName;
        $this->username = $username;
        $this->email = $email;
        $this->server = $server;
        $this->talents = $talents;
        $this->klass = $klass;
        $this->armory = $armory;
        $this->played = $played;
        $this->playClass = $playClass;
        $this->bio = $bio;
        $this->raidExperience = $raidExperience;
        $this->reasonToApplyFl = $reasonToApplyFl;
        $this->oldGuild = $oldGuild;
        $this->progressRaid = $progressRaid;
        $this->attendance = $attendance;
        $this->screenshot = $screenshot;
    }

}