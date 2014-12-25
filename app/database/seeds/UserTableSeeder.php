<?php

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'username' => 'Nigthshade',
                'password' => '1234',
                'email'    =>  'bjorngrunde@live.se'
            ]
        ];

        foreach($users as $user)
        {
            $newUser = User::create($user);

            $profile = new Profile;
            $profile->name = 'Björn';
            $profile->lastName = 'Grunde';
            $profile->klass = 'druid';
            $profile->rank = 'Raider';
            $profile->thumbnail = 'http://eu.battle.net/static-render/eu/grim-batol/170/95463850-avatar.jpg';
            $profile->avatar = 'http://eu.battle.net/static-render/eu/grim-batol/170/95463850-profilemain.jpg';
            $profile->save();

            $newUser->profile()->save($profile);

        }
    }
} 