<?php



class Raid extends Eloquent {

    protected $table = 'raids';

    protected $fillable = [ 'title','backgroundImg','description', 'time', 'startTime', 'endTime'];


    public function users()
    {
        return $this->belongsToMany('User', 'raid_user', 'raid_id', 'user_id')->withPivot('raid_role', 'raid_status');
    }

    public function comments()
    {
        return $this->morphMany('Fbf\LaravelComments\Comment', 'commentable');
    }
}