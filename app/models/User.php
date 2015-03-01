<?php

use Andheiberg\Messenger\Traits\UserCanMessage;
use Family\Eventing\EventGenerator;
use Family\Users\UserWasRemoved;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;
use Family\Registration\RegistrationWasPosted;
use Family\Users\UserWasUpdated;


class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, HasRole, EventGenerator, UserCanMessage;

	protected $table = 'users';

    protected $fillable = ['username', 'email', 'password'];

	protected $hidden = array('password', 'remember_token');


    public function post($name, $lastName, $username, $email, $rank, $klass, $server, $role)
    {
        $accessType = Role::whereName($role)->firstOrFail();
        $password = str_random(12);

        switch($rank)
        {
            case 'Trial':
                $forumRank = 5;
                break;
            case 'Social':
                $forumRank = 4;
                break;
            case 'Raider':
                $forumRank = 3;
                break;
            case 'Officer':
                $forumRank = 2;
                break;
            case 'Guild Mster':
                $forumRank = 2;
                break;
        }
        if ($img = Wow::getThumbnail($username, $server))
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
            $profile->forum_rank = $forumRank;
            $profile->save();

            $server = new Server;
            $server->server = Input::get('server');
            $server->save();

            $this->server()->save($server);

            $this->profile()->save($profile);

            $this->roles()->attach($accessType->id);

            $this->raise(new RegistrationWasPosted($this, $password));

            return $this;
        }

    }
    public function editPassword($username, $password)
    {
        $user = User::whereUsername($username)->firstOrFail();

        $user->password = $password;
        $user->save();

        $this->raise(new UserWasUpdated($user, $username));

        return $this;
    }
    public function editEmail($username, $email)
    {
        $user = User::whereUsername($username)->firstOrFail();

        $user->email = $email;
        $user->save();

        $this->raise(new UserWasUpdated($user, $username));
        return $this;
    }
    public function editRole($username, $role)
    {
        $user = User::with('roles')->whereUsername($username)->firstOrFail();

        $user->roles()->detach();

        $newRole = Role::whereId($role)->firstOrFail();

        $user->roles()->attach($newRole->id);

        $this->raise(new UserWasUpdated($user, $username));
        return $this;
    }
    public function edit($username, $name, $lastName, $klass, $rank, $phone)
    {
        $user = User::with('profile')->whereUsername($username)->firstOrFail();

        switch($rank) {
            case 'Trial':
                $forumRank = 5;
                break;
            case 'Social':
                $forumRank = 4;
                break;
            case 'Raider':
                $forumRank = 3;
                break;
            case 'Officer':
                $forumRank = 2;
                break;
            case 'Guild Mster':
                $forumRank = 2;
                break;
        }

            $user->profile->name = $name;
            $user->profile->lastName = $lastName;
            $user->profile->klass = $klass;
            $user->profile->rank = $rank;
            $user->profile->phone = $phone;
            $user->profile->forum_rank = $forumRank;
            $user->profile->save();

            $this->raise(new UserWasUpdated($user, $username));
            return $this;
    }

    public function remove($username)
    {
        $user = User::with('profile', 'server', 'threads', 'comments', 'raids')->whereUsername($username)->firstOrFail();
        $comments = Fbf\LaravelComments\Comment::whereUser_id($user->id)->delete();
        $photos = Photo::whereUser_id($user->id)->delete();
        $albums = Album::whereUser_id($user->id)->delete();

        $user->profile->delete();
        $user->server->delete();
        if(count($user->threads) > 0)
        {
            $user->threads()->delete();
        }
        if(count($user->comments) > 0)
        {

            $user->comments()->delete();
        }
        if(count($user->raids) > 0)
        {
            $user->raids()->detach();
        }
        $user->delete();



        $this->raise(new UserWasRemoved($user));
        return $this;
    }
    public function newNotification()
    {
        $notification = new Notification;
        $notification->user()->associate($this);
        return $notification;
    }

    public function hasRaid($id)
    {
        $user = User::with('raids')->whereUsername(Auth::user()->username)->firstOrFail();

           foreach($user->raids as $raid)
           {
               if($raid->id == $id)
               {
                   return true;
               }
           }
        return false;
    }
    public function hasMessage()
    {
      #  $conversation = Participant::where('user_id', '=', Auth::user()->id)->where('is_read')
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

    public function notifications()
    {
        return $this->hasMany('Notification');
    }

    public function albums()
    {
       return $this->hasMany('Album');
    }
    public function photos()
    {
       return $this->hasMany('Photo');
    }

    public function conversations()
    {
        return $this->hasMany('Conversation');
    }
}


