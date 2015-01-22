<?php

namespace Family\Listeners;


use Family\Eventing\EventListener;
use Family\Registration\RegistrationWasPosted;
use User;
use Auth;

class AdminNotifier extends EventListener
{
    public function whenApplicationWasPosted($event)
    {

    }

    public function whenApplicationWasUpdated($event)
    {

    }
    public function whenApplicationWasRemoved($event)
    {

    }

    public function whenRegistrationWasPosted(RegistrationWasPosted $event)
    {
        $users = User::whereHas('roles', function($q){
            $q->where('role_id', '=', 1)->orWhere('role_id', '=', 2);
        })->get();

        foreach($users as $user)
        {
           if($user->hasRole('Admin') || $user->hasRole('Utvecklare'))
           {
               $user->newNotification()
                   ->from(Auth::user())
                   ->withType('RegistrationWasPosted')
                   ->withSubject('En ny användare har skapats')
                   ->withBody('{{user}} har skapat en ny användare.')
                   ->regarding($event->user)
                   ->deliver();
           }
        }
    }
}