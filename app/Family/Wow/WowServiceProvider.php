<?php

namespace Family\Wow;



use Illuminate\Support\ServiceProvider;

class WowServiceProvider extends ServiceProvider {

    public function register()
    {
        $this->app->bind('wow', function()
            {
                return new \Family\Wow\Wow;
            });
    }
}