<?php

use Zizaco\Entrust\EntrustRole;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name' => 'Utvecklare',
            ],
            [
                'name' => 'Admin',
            ],
            [
                'name' => 'Medlem',
            ],
            [
                'name' => 'Inaktiv',
            ],
            [
                'name' => 'Bannad',
            ],
        ];

        foreach($roles as  $role)
        {
            EntrustRole::create($role);
        }
    }

}