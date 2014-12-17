<?php


class Status extends Eloquent {

	protected $table = 'status';
    protected $fillable = ['app_status'];

    /**
     * @return mixed
     */
    public function applications()
    {
        return $this->hasMany('Application');
    }


}