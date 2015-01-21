<?php

namespace Family\Gear;


use Illuminate\Support\ServiceProvider;

class ProfileFeedServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('profilefeed', function()
        {
            return new \Family\Gear\ProfileFeed;
        });
    }
} 