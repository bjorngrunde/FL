<?php


class ForumLocked extends Eloquent
{
    protected $table = 'forum_locked';

    protected $fillable = ['thread_id', 'locked'];

    public function threads()
    {
        return $this->belongsTo('ForumThread');
    }
} 