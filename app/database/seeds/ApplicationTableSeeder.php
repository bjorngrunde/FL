<?php

class ApplicationTableSeeder extends Seeder
{
    /**
     *
     */
    public function run()
    {
        $applications= [
            [
            'name'      => 'björn',
            'lastName'  => 'Johnsson',
            'email'     =>  'socaaaed@hotmail.com',
            'username'  =>  'Nattskugga',
            'server'    =>  'Grim Batol',
            'talents'   =>  'Marksman',
            'armory'    =>  'armory.com',
            'klass'     =>  'Hunter',
            ],
            [
                'name'      => 'andreas',
                'lastName'  => 'assjob',
                'email'     =>  'soiteeher@hotmail.com',
                'username'  =>  'Stickado',
                'server'    =>  'Grim Batol',
                'talents'   =>  'Marksman',
                'armory'    =>  'armory.com',
                'klass'     =>  'Hunter',
            ],
            [
                'name'      => 'ronald',
                'lastName'  => 'Kurson',
                'email'     =>  'seotherrrr@hotmail.com',
                'username'  =>  'Deshii',
                'server'    =>  'Grim Batol',
                'talents'   =>  'Super',
                'armory'    =>  'armory.com',
                'klass'     =>  'Hunter',
            ]
        ];

        foreach($applications as $application)
        {
            $apply = Application::create($application);

            $status = new Status;
            $status->app_status = 'default';
            $status->save();

            $status->applications()->save($apply);
        }
    }
}