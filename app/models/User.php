<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Entrust\HasRole;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, HasRole;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

    /**
     * Fillable Fields (massasign)
     * @var array
     */
    protected $fillable = ['username', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @return mixed
     */
    public function profile()
    {
        return $this->hasOne('Profile');
    }

    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany('Role', 'assigned_roles');
    }

    /**
     * @return mixed
     */
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

}


