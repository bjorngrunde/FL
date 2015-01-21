<?php

namespace Family\Listeners;


use Family\Applys\ApplicationWasPosted;
use Family\Eventing\EventListener;
use Family\Registration\RegistrationWasPosted;
use Family\Users\UserWasUpdated;
use User;
use Auth;
use Notification;

class AdminNotifier extends EventListener
{
    public function whenApplicationWasPosted( ApplicationWasPosted $event)
    {
        $users = User::whereHas('roles', function($q){
            $q->where('role_id', '=', 1)->orWhere('role_id', '=', 2);
        })->get();

        foreach($users as $user)
        {
            if($user->hasRole('Admin') || $user->hasRole('Utvecklare'))
            {
                    $user->newNotification()
                        ->withType('ApplicationsWasPosted')
                        ->withSubject('En ansökan har inkommit!')
                        ->withBody('En ny ansökan har inkommit!.')
                        ->regarding($event->application)
                        ->deliver();
            }
        }
    }

    public function whenApplicationWasUpdated($event)
    {

    }
    public function whenApplicationWasRemoved($event)
    {
        $users = User::whereHas('roles', function($q){
            $q->where('role_id', '=', 1)->orWhere('role_id', '=', 2);
        })->get();

        foreach($users as $user)
        {
            if($user->hasRole('Admin') || $user->hasRole('Utvecklare'))
            {
                if($user->username != Auth::user()->username)
                {
                $user->newNotification()
                    ->from(Auth::user())
                    ->withType('RegistrationWasRemoved')
                    ->withSubject('En ansökan togs bort!')
                    ->withBody('{{users}} har tagit bot en ansökan.')
                    ->regarding($event->application)
                    ->deliver();
                }
            }
        }
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
               if($user->username != Auth::user()->username)
               {
                   $user->newNotification()
                       ->from(Auth::user())
                       ->withType('RegistrationWasPosted')
                       ->withSubject('En ny användare har skapats')
                       ->withBody('{{users}} har skapat en ny användare.')
                       ->regarding($event->user)
                       ->deliver();
               }
           }
        }
    }
    public function whenUserWasUpdated(UserWasUpdated $event)
    {
        $users = User::whereHas('roles', function($q){
            $q->where('role_id', '=', 1)->orWhere('role_id', '=', 2);
        })->get();

        foreach($users as $user)
        {
            if($user->hasRole('Admin') || $user->hasRole('Utvecklare'))
            {
                    if($user->username != Auth::user()->username)
                    {
                        $user->newNotification()
                            ->from(Auth::user())
                            ->withType('UserWasUpdated')
                            ->withSubject('En användare har redigerats')
                            ->withBody('{{users}} har redigerat användaren '. $event->user->username)
                            ->regarding($event->user)
                            ->deliver();
                    }
            }
        }
    }
}