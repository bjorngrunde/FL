<?php

class Server extends Eloquent
{
    protected $table = 'servers';

    protected $fillable = ['user_id', 'server'];

    public function User()
    {
        return  $this->belongsTo('User');
    }
}