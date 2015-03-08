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
                        ->withBody('<li><a href="/admin/applications/'.$event->application->id.'"> Ny ansökan har inkommit </a></li>')
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
                            ->withBody('<li><a href="/admin/application/'.$event->application->id.'"> {{users}} har godkänt '. $event->application->name. ' '. $this->lastName. ' ansökan.</a></li>')
                            ->regarding($event->application)
                            ->deliver();
                    }
                    elseif($event->application->status->app_status == 'denied')
                    {
                        $user->newNotification()
                            ->from(Auth::user())
                            ->withType('ApplicationsWasUpdated')
                            ->withSubject('En ansökan har blivit nekad')
                            ->withBody('<li><a href="/admin/application/'.$event->application->id.'"> {{users}} har nekat '. $event->application->name. ' '. $this->lastName. ' ansökan. </a></li>')
                            ->regarding($event->application)
                            ->deliver();
                    }
                    else
                    {
                        $user->newNotification()
                            ->from(Auth::user())
                            ->withType('ApplicationsWasUpdated')
                            ->withSubject('En ansökan har blivit updaterad')
                            ->withBody('<li><a href="/admin/application/'.$event->application->id.'"> {{users}} har updaterat'. $event->application->name. ' '. $this->lastName. ' ansökan.</a></li>')
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
                    ->withBody('<li><a href="#"> {{users}} har tagit bot en ansökan.</a></li>')
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
                       ->withBody('<li><a href="/admin/users/'.$event->user->id .'"> {{users}} har skapat användaren '.$event->user->username. '</a></li>')
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
                        ->withBody('<li><a href="/admin/users/'.$event->user->id .'">{{users}} har redigerat användaren '. $event->user->username.'</a></li>')
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
                        ->withBody('<li><a href="#">{{users}} har tagit bort användaren '. $event->user->username.'</a></li>')
                        ->deliver();
                }
            }
        }
    }
}