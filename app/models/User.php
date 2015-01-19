<?php

use Family\Eventing\EventGenerator;
use Family\Wow\Wow;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;
use Family\Registration\RegistrationWasPosted;


class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, HasRole, EventGenerator;

	protected $table = 'users';

    protected $fillable = ['username', 'email', 'password'];

	protected $hidden = array('password', 'remember_token');


    public function post($name, $lastName, $username, $email, $rank, $klass, $server, $role)
    {
        if($role == 'Utvecklare')
        {
            if(!Auth::user()->hasRole('Utvecklare'))
            {
                return Redirect::back()->withFlashMessage('Du har inte behörighet att ange den rollen');
            }
        }

        $accessType = Role::whereName($role)->firstOrFail();
        $password = str_random(12);

        if ($img = $this->wow->getThumbnail($username, $server))
        {
            $avatar = str_replace('avatar', 'profilemain',$img);

            $this->username = $username;
            $this->email =  $email;
            $this->password = $password;

            $this->save();

            $profile = new Profile;
            $profile->name = $name;
            $profile->lastName = $lastName;
            $profile->rank = $rank;
            $profile->klass = $klass;
            $profile->thumbnail =$img;
            $profile->avatar = $avatar;
            $profile->save();

            $server = new Server;
            $server->server = Input::get('server');
            $server->save();

            $this->server()->save($server);

            $this->profile()->save($profile);

            $this->roles()->attach($accessType->id);

            $this->raise(new RegistrationWasPosted($this));

            return $this;
        }

    }

    public function newNotification()
    {
        $notification = new Notification;
        $notification->user()->associate($this);
        return $notification;
    }

    public function withSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function withBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function withType($type)
    {
        $this->type =$type;
        return $this;
    }

    public function regarding($object)
    {
        if(is_object($object))
        {
            $this->object_id = $object->id;
            $this->object_type = get_class($object);
        }
        return $this;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function profile()
    {
        return $this->hasOne('Profile');
    }
    public function roles()
    {
        return $this->belongsToMany('Role', 'assigned_roles');
    }

    public function server()
    {
        return $this->hasOne('Server');
    }
    public function raids()
    {
        return $this->belongsToMany('Raid', 'raid_user', 'user_id', 'raid_id')->withPivot('raid_role', 'raid_status');
    }

    public function groups()
    {
        return $this->hasMany('ForumGroup', 'author_id');
    }

    public function categories()
    {
        return $this->hasMany('ForumCategory', 'author_id');
    }
    public function threads()
    {
        return $this->hasMany('ForumThread', 'author_id');

    }
    public function comments()
    {
        return $this->hasMany('ForumComment', 'author_id');
    }

    public function posts()
    {
        return $this->hasMany('Post', 'user_id');
    }

    public function notifikations()
    {
        return $this->hasMany('Notification');
    }
}


