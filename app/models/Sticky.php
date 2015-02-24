<?php


class Sticky extends eloquent
{
    protected $table = 'stickys';

    protected $fillable = ['forum_thread_id', 'isSticky'];

    public function thread()
    {
        return $this->belongsTo('ForumThread');
    }
} 