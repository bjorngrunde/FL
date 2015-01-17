<?php
use Family\Applys\PostApplicationCommand;
use Family\Commanding\CommandBus;
use Family\Forms\ApplicationForm;

class ApplicationsController extends BaseController
{

    private $applicationForm;
    private $commandBus;

    function __construct(CommandBus $commandBus, ApplicationForm $applicationForm)
    {
        $this->commandBus = $commandBus;
        $this->applicationForm = $applicationForm;
    }

    public function index()
    {
        $applications = Application::with('status', 'comments')->orderBy('id','DESC')->paginate(25);

        return View::make('applications.index', compact('applications'));
    }

    public function create()
    {
        return View::make('applications.create');
    }

    public function store()
    {
        $input = Input::all();
        $this->applicationForm->validate($input);

        $command = new PostApplicationCommand(
            $input['name'],
            $input['lastName'],
            $input['username'],
            $input['email'],
            $input['server'],
            $input['talents'],
            $input['klass'],
            $input['armory'],
            $input['played'],
            $input['played'],
            $input['playClass'],
            $input['bio'],
            $input['raidExperience'],
            $input['reasonToApplyFl'],
            $input['oldGuild'],
            $input['progressRaid'],
            $input['attendance'],
            $input['screenshot']
        );
        $this->commandBus->execute($command);
       /* $application = new Application;
        $application->name = Input::get('name');
        $application->lastName = Input::get('lastName');
        $application->username = Input::get('username');
        $application->email = Input::get('email');
        $application->server = Input::get('server');
        $application->talents = Input::get('talents');
        $application->klass = Input::get('klass');
        $application->armory = Input::get('armory');
        $application->played = Input::get('played');
        $application->playClass = Input::get('playClass');
        $application->bio = Input::get('bio');
        $application->raidExperience = Input::get('raidExperience');
        $application->reasonToApplyFl = Input::get('reasonToApplyFl');
        $application->oldGuild = Input::get('oldGuild');
        $application->progressRaid = Input::get('progressRaid');
        $application->attendance = Input::get('attendance');


            catch (Exception $e)
            {
                return $e->getMessage();
            }
        }

        $application->save();

        $status = new Status;
        $status->app_status = 'default';
        $status->save();

        $status->Applys()->save($application);
       */
        return Redirect::back()->withFlashMessage('Tack för din ansökan, vi hör av oss via mail eller in-game när vi fattat ett beslut.');
    }

    /**
     * Display the specified resource.
     * GET /Applys/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id = null)
    {
        $application = Application::with('status')->findOrFail($id);
        return View::make('applications.show', ['application' => $application]);
    }

    /**
     * Show the form for editing the specified resource.
     * GET /Applys/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id = null)
    {
        $application = Application::with('status')->findOrFail($id);
        return View::make('applications.edit', ['application' => $application]);
    }

    /**
     * Update the specified resource in storage.
     * PUT /Applys/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id = null)
    {
        $application = Application::with('status')->findOrFail($id);

        $input = Input::all();
        $this->applicationForm->validate($input);

        $application->name = Input::get('name');
        $application->lastName = Input::get('lastName');
        $application->username = Input::get('username');
        $application->email = Input::get('email');
        $application->server = Input::get('server');
        $application->talents = Input::get('talents');
        $application->armory = Input::get('armory');
        $application->klass = Input::get('klass');
        $application->played = Input::get('played');
        $application->playClass = Input::get('playClass');
        $application->bio = Input::get('bio');
        $application->raidExperience = Input::get('raidExperience');
        $application->reasonToApplyFl = Input::get('reasonToApplyFl');
        $application->oldGuild = Input::get('oldGuild');
        $application->progressRaid = Input::get('progressRaid');
        $application->attendance = Input::get('attendance');
        $application->status->app_status = Input::get('app_status');

        if (Input::hasFile('screenshot'))
        {
            try
            {
                $file = Input::file('screenshot');
                $filepath = '/img/Applys/';
                $filename =  time() . '-application.jpg';
                $file = $file->move(public_path($filepath),$filename);

                $application->screenshot = $filepath.$filename;
            }
            catch (Exception $e)
            {
                return $e->getMessage();
            }
        }

        $application->status->save();

        return Redirect::back()->with('Success','Du har nu uppdaterat ansökan.');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /Applys/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id = null)
    {
        $application = Application::with('status')->findOrFail($id);

        $application->status->delete();
        $application->delete();

        return Redirect::to('/admin/applications')->with('flash_message', 'Ansökan bortagen!');
    }

}