<?php

class Album extends Eloquent {
    

    protected $table = 'albums';


    protected $primaryKey = 'album_id';


    protected $guarded = array();

    protected $softDelete = true;


    public function photos()
    {
    return $this->hasMany('Photo');
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function comments()
    {
        return $this->morphMany('Fbf\LaravelComments\Comment', 'commentable')->orderBy('created_at', 'desc');
    }

}