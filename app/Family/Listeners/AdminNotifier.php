<?php

namespace Family\Listeners;


use Family\Applys\ApplicationWasPosted;
use Family\Applys\ApplicationWasRemoved;
use Family\Applys\ApplicationWasUpdated;
use Family\Eventing\EventListener;
use Family\Registration\RegistrationWasPosted;
use Family\Users\UserWasRemoved;
use Family\Users\UserWasUpdated;
use User;
use Auth;


class AdminNotifier extends EventListener
{
    protected $lastName;

    public function whenApplicationWasPosted(ApplicationWasPosted $event)
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
                        ->withBody('En ny ansökan har inkommit')
                        ->regarding($event->application)
                        ->deliver();
            }
        }
    }

    public function whenApplicationWasUpdated(ApplicationWasUpdated $event)
    {
        $users = User::whereHas('roles', function($q){
            $q->where('role_id', '=', 1)->orWhere('role_id', '=', 2);
        })->get();


        $s = substr($event->application->lastName, -1);
        if(!$s == 's')
        {
            $this->lastName = $event->application->lastName.'s';
        }
        else
        {
            $this->lastName = $event->application->lastName;
        }

        foreach($users as $user)
        {
            if($user->hasRole('Admin') || $user->hasRole('Utvecklare'))
            {
                if($user->username != Auth::user()->username)
                {
                    if($event->application->status->app_status == 'approved')
                    {
                        $user->newNotification()
                            ->from(Auth::user())
                            ->withType('ApplicationsWasUpdated')
                            ->withSubject('En ansökan har blivit godkänd')
                            ->withBody('{{users}} har godkänt '. $event->application->name. ' '. $this->lastName. ' ansökan.')
                            ->regarding($event->application)
                            ->deliver();
                    }
                    elseif($event->application->status->app_status == 'denied')
                    {
                        $user->newNotification()
                            ->from(Auth::user())
                            ->withType('ApplicationsWasUpdated')
                            ->withSubject('En ansökan har blivit nekad')
                            ->withBody('{{users}} har nekat '. $event->application->name. ' '. $this->lastName. ' ansökan.')
                            ->regarding($event->application)
                            ->deliver();
                    }
                    else
                    {
                        $user->newNotification()
                            ->from(Auth::user())
                            ->withType('ApplicationsWasUpdated')
                            ->withSubject('En ansökan har blivit updaterad')
                            ->withBody('{{users}} har updaterat'. $event->application->name. ' '. $this->lastName. ' ansökan.')
                            ->regarding($event->application)
                            ->deliver();
                    }
                }
            }
        }
    }
    public function whenApplicationWasRemoved(ApplicationWasRemoved $event)
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
                       ->withBody('{{users}} har skapat användaren '.$event->user->username)
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

    public function whenUserWasRemoved(UserWasRemoved $event)
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
                        ->withType('UserWasRemoved')
                        ->withSubject('En användare har tagits bort')
                        ->withBody('{{users}} har tagit bort användaren '. $event->user->username)
                        ->deliver();
                }
            }
        }
    }
}