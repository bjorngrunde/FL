<?php

class Point extends Eloquent
{
    protected $table = 'points';

    protected $fillable = ['points', 'user_id'];

    public function User()
    {
        return $this->belongsTo('User');
    }
} 