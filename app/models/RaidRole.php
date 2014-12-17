<?php

class RaidRole extends Eloquent {

    protected $table = ['raidroles'];

    protected $fillable = ['role', 'status'];

    public function users()
    {
        return $this->belongsTo('User');
    }
    public function morphable()
    {
        return $this->morphTo();
    }
} 