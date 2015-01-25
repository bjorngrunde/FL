<?php

use Family\Applys\ApplicationWasPosted;
use Family\Applys\ApplicationWasUpdated;
use Family\Applys\ApplicationWasRemoved;
use Family\Eventing\EventGenerator;

class Application extends Eloquent
{
    use EventGenerator;

    protected $table = 'applications';

    protected $fillable = [
        'name',
        'lastName',
        'username',
        'email',
        'server',
        'talents',
        'klass',
        'armory',
        'played',
        'playClass',
        'bio',
        'raidExperience',
        'reasonToApplyFl',
        'oldGuild',
        'progressRaid',
        'attendance',
        'screenshot'
    ];

    protected $guarded = [];

    public function post($name, $lastName, $username, $email, $server, $talents, $klass, $armory, $played, $playClass, $bio, $raidExperience, $reasonToApplyFl, $oldGuild, $progressRaid, $attendance, $screenshot)
    {
        $this->name             = $name;
        $this->lastName         = $lastName;
        $this->username         = $username;
        $this->email            = $email;
        $this->server           = $server;
        $this->talents          = $talents;
        $this->klass            = $klass;
        $this->armory           = $armory;
        $this->played           = $played;
        $this->playClass        = $playClass;
        $this->bio              = $bio;
        $this->raidExperience   = $raidExperience;
        $this->reasonToApplyFl  = $reasonToApplyFl;
        $this->oldGuild         = $oldGuild;
        $this->progressRaid     = $progressRaid;
        $this->attendance       = $attendance;

        if(!empty($screenshot))
        {
            try
            {
                $file = $screenshot;
                $filename = time() . '-application.jpg';
                $filepath = '/img/applications/';
                $file = $file->move(public_path($filepath),$filename);

                $this->screenshot = $filepath.$filename;
            }
            catch(Exception $e)
            {
                return 'Något gick snett mannen: ' .$e;
            }
        }
        $this->save();

        $status = new Status;
        $status->app_status = 'default';
        $status->save();

        $status->Applications()->save($this);

        $this->raise(new ApplicationWasPosted($this));

        return $this;
    }
    public function change($name, $lastName, $username, $email, $server, $talents, $klass, $armory, $played, $playClass, $bio, $raidExperience, $reasonToApplyFl, $oldGuild, $progressRaid, $attendance, $screenshot, $app_status)
    {
        $this->name             = $name;
        $this->lastName         = $lastName;
        $this->username         = $username;
        $this->email            = $email;
        $this->server           = $server;
        $this->talents          = $talents;
        $this->klass            = $klass;
        $this->armory           = $armory;
        $this->played           = $played;
        $this->playClass        = $playClass;
        $this->bio              = $bio;
        $this->raidExperience   = $raidExperience;
        $this->reasonToApplyFl  = $reasonToApplyFl;
        $this->oldGuild         = $oldGuild;
        $this->progressRaid     = $progressRaid;
        $this->attendance       = $attendance;

        if(!empty($screenshot))
        {
            try
            {
                $file = $screenshot;
                $filename = time() . '-application.jpg';
                $filepath = '/img/applications/';
                $file = $file->move(public_path($filepath),$filename);

                $this->screenshot = $filepath.$filename;
            }
            catch(Exception $e)
            {
                return 'Något gick snett mannen: ' .$e;
            }
        }

        $this->status->app_status  =   $app_status;

        $this->status->save();

        $this->raise(new ApplicationWasUpdated($this));

        return $this;

    }
    public function remove($id)
    {
        $application = Application::with('status')->whereId($id)->firstOrFail();
        $application->status->delete();
        $application->delete();

        $this->raise(new ApplicationWasRemoved($this));

        return $this;
    }

    public function status()
    {
        return $this->belongsTo('Status');
    }
    public function comments()
    {
        return $this->morphMany('Fbf\LaravelComments\Comment', 'commentable');
    }
}
