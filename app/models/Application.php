<?php

use Family\Eventing\EventGenerator;

class Application extends Eloquent
{
    use EventGenerator;

    protected $table = 'Applications';

    protected $fillable = [
        'name',
        'lastName',
        'username',
        'email',
        'server',
        'talents',
        'armory',
        'played',
        'playClass',
        'bio',
        'raidExperience',
        'reasonToApplyFl',
        'oldGuild',
        'progressRaid',
        'attendance',
        'screenshot',
        'other',
        'klass'
    ];

    protected $guarded = [];

    /**
     * @return mixed
     */
    public function post($name, $lastName, $username, $email, $server, $talents, $armory, $played, $playClass, $bio, $raidExperience, $reasonToApplyFl, $oldGuild, $progressRaid, $attendance, $screenshot, $klass)
    {
        $this->name             = $name;
        $this->lastName         = $lastName;
        $this->username         = $username;
        $this->email            = $email;
        $this->server           = $server;
        $this->talents          = $talents;
        $this->armory           = $armory;
        $this->played           = $played;
        $this->playClass        = $playClass;
        $this->bio              = $bio;
        $this->raidExperience   = $raidExperience;
        $this->reasonToApplyFl  = $reasonToApplyFl;
        $this->oldGuild         = $oldGuild;
        $this->progressRaid     = $progressRaid;
        $this->attendance       = $attendance;
        $this->klass            = $klass;
        if(Input::hasfile($screenshot))
        {
            try
            {
                $file = Input::file($screenshot);
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

    public function status()
    {
        return $this->belongsTo('Status');
    }
    public function comments()
    {
        return $this->morphMany('Fbf\LaravelComments\Comment', 'commentable');
    }
}
