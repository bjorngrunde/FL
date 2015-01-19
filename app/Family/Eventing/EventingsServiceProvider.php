<?php

namespace Family\Eventing;


use Illuminate\Support\ServiceProvider;

class EventingsServiceProvider extends ServiceProvider {

    public function register()
    {
        $listeners = $this->app['config']->get('family.listeners');

        foreach($listeners as $listener)
        {
            $this->app['events']->listen('Family.*', $listener);
        }
    }
}