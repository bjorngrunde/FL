<?php

namespace Family\Listeners;


use Family\Applys\ApplicationWasPosted;
use Family\Eventing\EventListener;
use Family\Mailer\UserMailer as Mailer;
use Family\Registration\RegistrationWasPosted;
use User;
class EmailNotifier extends EventListener {

    private $mailer;

    function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
    public function whenRegistrationWasPosted(RegistrationWasPosted $event)
    {
      # $user = User::whereUsername($event->user->username)->firstOrFail();

        #$this->mailer->welcome($user, $event->password);
    }


    public function whenApplicationWasPosted(ApplicationWasPosted $event)
    {
        $users = User::with('roles')->get();

        foreach ($users as $user)
        {
            if($user->hasRole('Utvecklare') || $user->hasRole('Admin') )
            {
                $this->mailer->applicationRegistered($user, $event);
            }
        }
    }
} 