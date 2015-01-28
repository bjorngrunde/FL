<?php

class Profile extends Eloquent {
    
    protected $table = 'profiles';
    protected $fillable = ['name', 'lastName','phone', 'rank','avatar', 'klass','thumbnail', 'forum_rank' ];

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('User');
    }
}