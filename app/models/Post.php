<?php

class Post extends Eloquent
{
    protected $table = 'posts';

    protected $fillable = ['title', 'body', 'thumbnail', 'img', 'user_id'];

    public function user()
    {
       return $this->belongsTo('User');
    }

    public function comments()
    {
        return $this->morphMany('Fbf\LaravelComments\Comment', 'commentable')->orderBy('created_at', 'desc');
    }
}