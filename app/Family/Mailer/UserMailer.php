<?php namespace Family\Mailer;


use User;

class UserMailer extends Mailer
{
    /**
     * @param User $user
     * @param $password
     */
    public function welcome(User $user, $password)
    {
        $view = 'emails.registration.welcome';
        $data = ['username' => $user['username'], 'email' => $user['email'], 'password' => $password ];
        $subject = 'Välkommen till Family Legion';

        return $this->sendTo($user, $subject, $view, $data);
    }
}