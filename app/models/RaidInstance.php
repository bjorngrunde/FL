<?php


class RaidInstance extends Eloquent
{
    protected $table = 'raidInstance';

    protected $fillable = ['title', 'backgroundImg'];

    public function Raids()
    {
       return $this->hasMany('Raid');
    }
}